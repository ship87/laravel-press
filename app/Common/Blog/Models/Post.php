<?php

namespace App\Common\Blog\Models;

use App\Traits\Comment;
use App\Traits\MetaTag;
use App\Traits\Slug;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Post
 *
 * @package App\Common\Page\Models
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $content
 * @property int $allow_comments
 * @property bool $published
 * @property string|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Common\Page\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read \App\Common\Comment\Models\Comment $comment
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property string|null $meta_title
 * @property-read \App\Common\Seo\Models\MetaTag $meta
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Common\Page\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Post whereAllowComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Post wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Post wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Post whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Blog\Models\Post published()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Blog\Models\Post withRelations()
 * @property string|null $preview_content
 * @property int $comment_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Common\Comment\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Blog\Models\Post exclude($value = [])
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Blog\Models\Post whereCommentCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Blog\Models\Post wherePreviewContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Blog\Models\Post withRelationsPreview()
 * @property int $comment_published_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Blog\Models\Post whereCommentPublishedCount($value)
 */
class Post extends Model
{
    use MetaTag, Comment, Slug;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'preview_content',
        'content',
        'allow_comments',
        'comment_count',
        'comment_published_count',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'published' => 'boolean',
        'published_at' => 'datetime'
    ];

    /**
     * @var array
     */
    protected $columns = [
        'id',
        'title',
        'slug',
        'preview_content',
        'content',
        'comment_count',
        'comment_published_count',
        'allow_comments',
        'published',
        'published_at',
        'created_at',
        'updated_at'
    ];

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * @param $query
     * @return Builder
     */
    public function scopePublished($query): Builder
    {
        return $query->where('published', true);
    }

    /**
     * @param $builder
     * @return Builder
     */
    public function scopeWithRelationsPreview($builder): Builder
    {
        return $builder->with(['categories', 'tags']);
    }

    /**
     * @param $builder
     * @return Builder
     */
    public function scopeWithRelations($builder): Builder
    {
        return $builder->with(['categories', 'tags', 'comments']);
    }

    /**
     * @param $query
     * @param array $value
     * @return mixed
     */
    public function scopeExclude(Builder $query, $value = array()): Builder
    {
        return $query->select(array_diff($this->columns, (array)$value));
    }

    /**
     * @return null|Category
     */
    public function getFirstCategory(): ?Category
    {
        return $this->categories->isNotEmpty() ? $this->categories->first() : null;
    }
}
