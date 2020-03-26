<?php

namespace App\Common\ImportData\Services;

use Illuminate\Support\Facades\DB;
use App\Common\Page\Models\Post as PostModel;
use App\Common\Page\Models\Page as PageModel;

/**
 * Class ImportDataWordpress
 * @package App\Common\ImportData\Services
 */
class ImportDataWordpress
{
    /**
     * @var string
     */
    private $prefix;

    /**
     * ImportDataWordpress constructor.
     * @param string $prefix
     */
    public function __construct(string $prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * Import posts from Wordpress
     */
    public function importPosts(): void
    {
        $postsWordpress = DB::table($this->prefix . 'posts')
            ->where('post_type', 'post')
            ->cursor();

        foreach ($postsWordpress as $postWordpress) {

            $post = PostModel::firstOrNew(['slug' => $postWordpress->post_name]);
            $post->title = $postWordpress->post_title;
            $post->slug = $postWordpress->post_name;
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
        $pagesWordpress = DB::table($this->prefix . 'posts')
            ->where('post_type', 'page')
            ->cursor();

        foreach ($pagesWordpress as $pageWordpress) {

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

        $pagesWordpress = DB::table($this->prefix . 'posts')
            ->where('post_type', 'page')
            ->cursor();

        foreach ($pagesWordpress as $pageWordpress) {

            if ($pageWordpress->post_parent === 0) {
                continue;
            }

            $page = PageModel::where('slug', $pageWordpress->post_name)->first();
            if (!($page instanceof PageModel)) {
                continue;
            }

            $pageParent = DB::table($this->prefix . 'posts')
                ->where('post_type', 'page')
                ->where('ID', $pageWordpress->post_parent)
                ->first();
            if ($pageParent === null) {
                continue;
            }

            $pageParentWordpress = PageModel::where('slug', $pageParent->post_name)->first();
            if (!($pageParentWordpress instanceof PageModel)) {
                continue;
            }

            $page->parent_id = $pageParentWordpress->id;
            $page->save();
        }
    }
}