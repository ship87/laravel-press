<?php

namespace App\Common\Setting\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 *
 * @package App\Common\Setting\Models
 * @property int $id
 * @property string $name
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Setting\Models\Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Setting\Models\Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Setting\Models\Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Setting\Models\Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Setting\Models\Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Setting\Models\Setting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Setting\Models\Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Setting\Models\Setting whereValue($value)
 * @mixin \Eloquent
 */
class Setting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'value'
    ];
}
