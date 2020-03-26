<?php

namespace App\Common\Page\Models;

use App\Traits\Comment;
use App\Traits\MetaTag;
use App\Traits\Slug;
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
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'published' => 'boolean',
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
}
