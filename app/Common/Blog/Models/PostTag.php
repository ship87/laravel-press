<?php

namespace App\Common\Blog\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PostTag
 *
 * @package App\Common\Page\Models
 * @property int $post_id
 * @property int $tag_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\PostTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\PostTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\PostTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\PostTag wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\PostTag whereTagId($value)
 * @mixin \Eloquent
 */
class PostTag extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'post_tag';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'tag_id',
    ];
}
