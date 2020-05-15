<?php

namespace App\Common\Blog\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryPost
 *
 * @package App\Common\Page\Models
 * @property int $category_id
 * @property int $post_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\CategoryPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\CategoryPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\CategoryPost query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\CategoryPost whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\CategoryPost wherePostId($value)
 * @mixin \Eloquent
 */
class CategoryPost extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category_post';

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
        'category_id',
        'post_id',
    ];
}
