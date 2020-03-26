<?php

namespace App\Common\Page\Models;

use App\Traits\Slug;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 *
 * @package App\Common\Page\Models
 * @property int $id
 * @property string $title
 * @property string $slug
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Tag whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Page\Models\Tag whereTitle($value)
 * @mixin \Eloquent
 */
class Tag extends Model
{
    use Slug;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * @var bool
     */
    public $timestamps = false;
}
