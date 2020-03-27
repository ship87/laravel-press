<?php

namespace App\Common\Page\Models;

use App\Traits\Slug;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * @package App\Common\Page\Models
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $parent_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Category whereTitle($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    use Slug;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

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
        'slug',
        'title',
    ];
}
