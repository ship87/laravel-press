<?php

namespace App\Common\ImportData\Services;

use App\Common\Blog\Models\CategoryPost;
use App\Helpers\Word;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\LazyCollection;
use App\Common\Blog\Models\Post as PostModel;
use App\Common\Page\Models\Page as PageModel;
use App\Common\Blog\Models\Category as CategoryModel;
use App\Common\Blog\Models\Tag as TagModel;
use App\Common\Blog\Models\CategoryPost as CategoryPostModel;
use App\Common\Blog\Models\PostTag as PostTagModel;
use App\Common\Comment\Models\Comment as CommentModel;
use App\Common\Setting\Services\Setting as SettingService;

/**
 * Class ImportDataWordpress
 * @package App\Common\ImportData\Services
 */
class ImportDataWordpress
{
    /**
     * @var string
     */
    public const POST_TYPE_POST = 'post';

    /**
     * @var string
     */
    public const POST_TYPE_PAGE = 'page';

    /**
     * @var string
     */
    public const TERM_TYPE_CATEGORY = 'category';

    /**
     * @var string
     */
    public const TERM_TYPE_TAG = 'post_tag';

    /**
     * @var array
     */
    public const ALLOWED_COMMENTS_POST_TYPES = [
        self::POST_TYPE_POST => PostModel::class,
        self::POST_TYPE_PAGE => PageModel::class
    ];

    /**
     * @var string
     */
    private $prefix;

    /**
     * @var SettingService
     */
    private $settingService;

    /**
     * ImportDataWordpress constructor.
     * @param string $prefix
     */
    public function __construct(string $prefix, SettingService $settingService)
    {
        $this->prefix = $prefix;
        $this->settingService = $settingService;
    }

    /**
     * Import comments from Wordpress
     */
    public function importComments(): void
    {
        $commentsWordpress = $this->getCommentsWordpressQuery()->cursor();

        foreach ($commentsWordpress as $commentWordpress) {

            if (!isset(self::ALLOWED_COMMENTS_POST_TYPES[$commentWordpress->post_type])) {
                continue;
            }

            $page = PageModel::where('slug', $commentWordpress->post_name)->first();
            if (!($page instanceof PageModel)) {
                $page = PostModel::where('slug', $commentWordpress->post_name)->first();
                if (!($page instanceof PostModel)) {
                    continue;
                }
            }

            $modelType = self::ALLOWED_COMMENTS_POST_TYPES[$commentWordpress->post_type];
            $entityId = $page->id;
            $entityType = array_search($modelType, Relation::morphMap());


            $commentPublished = $commentWordpress->comment_approved === 1 ? true : false;
            /*
             * @var $comment CommentModel
             */
            $comment = CommentModel::firstOrNew(['wordpress_comment_id' => $commentWordpress->comment_ID]);
            $comment->wordpress_comment_id = $commentWordpress->comment_ID;
            $comment->author_name = $commentWordpress->comment_author;
            $comment->author_email = $commentWordpress->comment_author_email;
            $comment->content = $commentWordpress->comment_content;
            $comment->entity_id = $entityId;
            $comment->entity_type = $entityType;
            $comment->content = $commentWordpress->comment_content;
            $comment->published = $commentPublished;
            $comment->created_at = $commentWordpress->comment_date;
            $comment->updated_at = $commentWordpress->comment_date;
            $comment->save();

            $updatePageData = [
                'comment_count' => DB::raw('comment_count+1'),
            ];
            if ($commentPublished) {
                $updatePageData['comment_published_count'] = DB::raw('comment_published_count+1');
            }
            $page->update($updatePageData);

        }

        $this->importParentComments();
    }

    /**
     * Import categories from Wordpress
     */
    public function importCategories(): void
    {
        $categoriesWordpress = $this->getTermsWordpressQuery(self::TERM_TYPE_CATEGORY)->cursor();

        foreach ($categoriesWordpress as $categoryWordpress) {

            /**
             * @var $category CategoryModel
             */
            $category = CategoryModel::firstOrNew(['slug' => $categoryWordpress->slug]);
            $category->title = $categoryWordpress->name;
            $category->slug = $categoryWordpress->slug;
            $category->save();
        }

        $this->importParentCategories();
    }

    /**
     * Import tags from Wordpress
     */
    public function importTags(): void
    {
        $tagsWordpress = $this->getTermsWordpressQuery(self::TERM_TYPE_TAG)->cursor();

        foreach ($tagsWordpress as $tagWordpress) {

            /**
             * @var $tag TagModel
             */
            $tag = TagModel::firstOrNew(['slug' => $tagWordpress->slug]);
            $tag->title = $tagWordpress->name;
            $tag->slug = $tagWordpress->slug;
            $tag->save();
        }

        $this->importParentCategories();
    }

    /**
     * Import categories and posts relationships from Wordpress
     */
    public function importCategoryPost(): void
    {
        $categoriesPostsWordpress = $this->getTermRelationshipsWordpress(
            self::POST_TYPE_POST,
            self::TERM_TYPE_CATEGORY);

        foreach ($categoriesPostsWordpress as $categoryPostWordpress) {

            $category = CategoryModel::where('slug', $categoryPostWordpress->slug)->first();
            $post = PostModel::where('slug', $categoryPostWordpress->post_name)->first();

            if (!($category instanceof CategoryModel) || !($post instanceof PostModel)) {
                continue;
            }

            CategoryPostModel::firstOrCreate(['category_id' => $category->id, 'post_id' => $post->id]);
        }
    }

    /**
     * Import posts and tags relationships from Wordpress
     */
    public function importPostTag(): void
    {
        $postsTagsWordpress = $this->getTermRelationshipsWordpress(
            self::POST_TYPE_POST,
            self::TERM_TYPE_TAG);

        foreach ($postsTagsWordpress as $postTagWordpress) {

            $post = PostModel::where('slug', $postTagWordpress->post_name)->first();
            $tag = TagModel::where('slug', $postTagWordpress->slug)->first();

            if (!($post instanceof PostModel) || !($tag instanceof TagModel)) {
                continue;
            }

            PostTagModel::firstOrCreate(['post_id' => $post->id, 'tag_id' => $tag->id]);
        }
    }

    /**
     * Import posts from Wordpress
     */
    public function importPosts(): void
    {
        $sizePostPreviewContent = $this->settingService->getSizePostPreviewContent();
        $postsWordpress = $this->getPostsWordpressQuery(self::POST_TYPE_POST)->cursor();

        foreach ($postsWordpress as $postWordpress) {

            /**
             * @var $post PostModel
             */
            $post = PostModel::firstOrNew(['slug' => $postWordpress->post_name]);
            $post->title = $postWordpress->post_title;
            $post->slug = $postWordpress->post_name;
            $post->preview_content = strip_tags(Word::getPartString($postWordpress->post_content, $sizePostPreviewContent));
            $post->content = $postWordpress->post_content;
            $post->published = $postWordpress->post_status === 'publish' ? true : false;
            $post->published_at = $postWordpress->post_date;
            $post->allow_comments = $postWordpress->comment_status === 'open' ? true : false;
            $post->created_at = $postWordpress->post_date;
            $post->updated_at = $postWordpress->post_modified;
            $post->save();
        }
    }

    /**
     * Import pages from Wordpress
     */
    public function importPages(): void
    {
        $pagesWordpress = $this->getPostsWordpressQuery(self::POST_TYPE_PAGE)->cursor();

        foreach ($pagesWordpress as $pageWordpress) {

            /**
             * @var $page PageModel
             */
            $page = PageModel::firstOrNew(['slug' => $pageWordpress->post_name]);
            $page->title = $pageWordpress->post_title;
            $page->slug = $pageWordpress->post_name;
            $page->content = $pageWordpress->post_content;
            $page->published = $pageWordpress->post_status === 'publish' ? true : false;
            $page->allow_comments = $pageWordpress->comment_status === 'open' ? true : false;
            $page->created_at = $pageWordpress->post_date;
            $page->updated_at = $pageWordpress->post_modified;
            $page->save();
        }

        $this->importParentPages();
    }

    /**
     * Import parent pages from Wordpress
     */
    private function importParentPages(): void
    {
        $pagesWordpress = $this->getPostsWordpressQuery(self::POST_TYPE_PAGE)->cursor();

        foreach ($pagesWordpress as $pageWordpress) {

            if ($pageWordpress->post_parent === 0) {
                continue;
            }

            $page = PageModel::where('slug', $pageWordpress->post_name)->first();
            if (!($page instanceof PageModel)) {
                continue;
            }

            $pageParentWordpress = $this
                ->getPostsWordpressQuery(self::POST_TYPE_PAGE, $pageWordpress->post_parent)
                ->first();

            if ($pageParentWordpress === null) {
                continue;
            }

            $pageParent = PageModel::where('slug', $pageParentWordpress->post_name)->first();
            if (!($pageParent instanceof PageModel)) {
                continue;
            }

            $page->parent_id = $pageParent->id;
            $page->save();
        }
    }

    /**
     * Import parent categories from Wordpress
     */
    private function importParentCategories(): void
    {
        $categoriesWordpress = $this->getTermsWordpressQuery(self::TERM_TYPE_CATEGORY)->cursor();

        foreach ($categoriesWordpress as $categoryWordpress) {

            if ($categoryWordpress->parent === 0) {
                continue;
            }

            $category = CategoryModel::where('slug', $categoryWordpress->slug)->first();
            if (!($category instanceof CategoryModel)) {
                continue;
            }

            $categoryParentWordpress = $this
                ->getTermsWordpressQuery(self::TERM_TYPE_CATEGORY, $categoryWordpress->parent)
                ->first();

            if ($categoryParentWordpress === null) {
                continue;
            }

            $categoryParent = CategoryModel::where('slug', $categoryParentWordpress->slug)->first();
            if (!($categoryParent instanceof CategoryModel)) {
                continue;
            }

            $category->parent_id = $categoryParent->id;
            $category->save();
        }
    }

    /**
     * Import parent comments from Wordpress
     */
    private function importParentComments(): void
    {
        $commentsWordpress = $this->getCommentsWordpressQuery()->cursor();

        foreach ($commentsWordpress as $commentWordpress) {

            if ($commentWordpress->comment_parent === 0) {
                continue;
            }

            $comment = CommentModel::where('wordpress_comment_id', $commentWordpress->comment_ID)->first();
            if (!($comment instanceof CommentModel)) {
                continue;
            }
            $commentParentWordpress = $this
                ->getCommentsWordpressQuery($commentWordpress->comment_parent)
                ->first();
            if ($commentParentWordpress === null) {
                continue;
            }

            $commentParent = CommentModel::where('wordpress_comment_id', $commentParentWordpress->comment_ID)->first();
            if (!($commentParent instanceof CommentModel)) {
                continue;
            }

            $comment->parent_id = $commentParent->id;
            $comment->save();
        }
    }

    /**
     * @param string $type
     * @param int|null $id
     * @return Builder
     */
    private function getPostsWordpressQuery(string $type, ?int $id = null): Builder
    {
        $postsWordpress = DB::table($this->prefix . 'posts')
            ->where('post_type', $type);

        if ($id !== null) {
            $postsWordpress->where('ID', $id);
        }

        return $postsWordpress;
    }

    /**
     * @param string $type
     * @param int|null $termTaxonomyId
     * @return Builder
     */
    private function getTermsWordpressQuery(string $type, ?int $termTaxonomyId = null): Builder
    {
        $termsWordpress = DB::table($this->prefix . 'term_taxonomy')
            ->where('taxonomy', $type)
            ->join($this->prefix . 'terms',
                $this->prefix . 'term_taxonomy.term_taxonomy_id',
                '=',
                $this->prefix . 'terms.term_id');

        if ($termTaxonomyId !== null) {
            $termsWordpress->where('term_taxonomy_id', $termTaxonomyId);
        }

        return $termsWordpress;
    }

    /**
     * @param string $typePost
     * @param string $typeCategory
     * @return LazyCollection
     */
    private function getTermRelationshipsWordpress(string $typePost, string $typeCategory): LazyCollection
    {
        return DB::table($this->prefix . 'term_relationships')
            ->join($this->prefix . 'posts',
                $this->prefix . 'term_relationships.object_id',
                '=',
                $this->prefix . 'posts.ID')
            ->join($this->prefix . 'term_taxonomy',
                $this->prefix . 'term_relationships.term_taxonomy_id',
                '=',
                $this->prefix . 'term_taxonomy.term_taxonomy_id')
            ->join($this->prefix . 'terms',
                $this->prefix . 'term_taxonomy.term_taxonomy_id',
                '=',
                $this->prefix . 'terms.term_id')
            ->where('post_type', $typePost)
            ->where('taxonomy', $typeCategory)
            ->select('post_name', 'slug')
            ->cursor();
    }

    /**
     * @param int|null $id
     * @return Builder
     */
    private function getCommentsWordpressQuery(?int $id = null): Builder
    {
        $commentsWordpress = DB::table($this->prefix . 'comments')
            ->join($this->prefix . 'posts',
                $this->prefix . 'comments.comment_post_ID',
                '=',
                $this->prefix . 'posts.ID');

        if ($id !== null) {
            $commentsWordpress->where('comment_ID', $id);
        }

        return $commentsWordpress;
    }
}