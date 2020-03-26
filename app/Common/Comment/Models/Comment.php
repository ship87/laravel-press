<?php

namespace App\Common\Comment\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 *
 * @package App\Common\Seo\Models
 * @property int $id
 * @property string|null $content
 * @property string $author_name
 * @property string $author_email
 * @property int $published
 * @property string $entity_type
 * @property int $entity_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $entity
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Comment\Models\Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Comment\Models\Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Comment\Models\Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Comment\Models\Comment whereAuthorEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Comment\Models\Comment whereAuthorName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Comment\Models\Comment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Comment\Models\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Comment\Models\Comment whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Comment\Models\Comment whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Comment\Models\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Comment\Models\Comment wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Comment\Models\Comment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Comment extends Model
{
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'author_name',
        'author_email',
        'entity_type',
        'entity_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function entity()
    {
        return $this->morphTo();
    }
}
