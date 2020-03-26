<?php

namespace App\Common\Seo\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MetaTag
 *
 * @package App\Common\Seo\Models
 * @property int $id
 * @property string|null $title
 * @property string|null $keywords
 * @property string|null $description
 * @property string $entity_type
 * @property int $entity_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $entity
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Seo\Models\MetaTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Seo\Models\MetaTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Seo\Models\MetaTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Seo\Models\MetaTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Seo\Models\MetaTag whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Seo\Models\MetaTag whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Seo\Models\MetaTag whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Seo\Models\MetaTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Seo\Models\MetaTag whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Seo\Models\MetaTag whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Common\Seo\Models\MetaTag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MetaTag extends Model
{
    /**
     * @var int
     */
    public const MAX_LENGTH_META_TITLE = 255;

    /**
     * @var int
     */
    public const MAX_LENGTH_META_DESCRIPTION = 512;

    /**
     * @var int
     */
    public const MAX_LENGTH_META_KEYWORDS = 512;

    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'meta_tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'keywords',
        'description',
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

    /**
     * @return string
     */
    public static function getRulesValidationTitle()
    {

        return 'max:' . self::MAX_LENGTH_META_TITLE;
    }

    /**
     * @return string
     */
    public static function getRulesValidationDescription()
    {

        return 'max:' . self::MAX_LENGTH_META_DESCRIPTION;
    }

    /**
     * @return string
     */
    public static function getRulesValidationKeywords()
    {

        return 'max:' . self::MAX_LENGTH_META_KEYWORDS;
    }
}
