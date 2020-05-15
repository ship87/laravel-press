<?php

namespace App\Common\Page\Models;

use App\Traits\Comment;
use App\Traits\MetaTag;
use App\Traits\Slug;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Page
 *
 * @package App\Common\Page\Models
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int|null $parent_id
 * @property string|null $content
 * @property bool $published
 * @property int $allow_comments
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Common\Comment\Models\Comment $comment
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property string|null $meta_title
 * @property-read \App\Common\Seo\Models\MetaTag $meta
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Page whereAllowComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Page whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Page whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Page wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Page whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Page whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $comment_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Common\Comment\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Page whereCommentCount($value)
 * @property int $comment_published_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Page whereCommentPublishedCount($value)
 */
class Page extends Model
{
    use MetaTag, Comment, Slug;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
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
    ];
}
