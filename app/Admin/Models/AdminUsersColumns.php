<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminUsersColumns
 *
 * @package App\Admin\Models
 * @property int $id
 * @property int $user_id
 * @property string $columns
 * @property string $route
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Models\AdminUsersColumns newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Models\AdminUsersColumns newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Models\AdminUsersColumns query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Models\AdminUsersColumns whereColumns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Models\AdminUsersColumns whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Models\AdminUsersColumns whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin\Models\AdminUsersColumns whereUserId($value)
 * @mixin \Eloquent
 */
class AdminUsersColumns extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_users_columns';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'columns',
        'route'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;
}
