<?php

namespace App\Traits;

use App\Common\Seo\Models\MetaTag as MetaTagModel;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Trait MetaTag
 * @package App\Traits
 */
trait MetaTag
{
    /**
     * @return bool
     */
    public function saveMetaTag(): bool
    {
        $meta = $this->meta;

        if (empty($meta) || $this->id === null) {
            return false;
        }

        $meta->entity_id = $this->id;

        return $meta->save();
    }

    /**
     * @return bool
     */
    public function deleteMetaTag(){

        return $this->meta()->delete();
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null
     *
     * @throws \Exception
     */
    public function delete()
    {
        $this->meta()->delete();

        return parent::delete();
    }

    /**
     * Get an attribute array of all arrayable attributes.
     *
     * @return array
     */
    protected function getArrayableAppends()
    {
        $this->appends = array_unique(array_merge($this->appends, [
                'meta_title',
                'meta_description',
                'meta_keywords'
            ]
        ));

        return parent::getArrayableAppends();
    }


    /**
     * @return string|null
     */
    public function getMetaTitleAttribute()
    {
        $metaTag = $this->findMetaTag();

        if (!$metaTag) {
            return null;
        }

        return $metaTag->title;
    }

    /**
     * @param $metaTitle
     */
    public function setMetaTitleAttribute($metaTitle): void
    {
        $this->createRelationMetaIfNotExist();
        $this->meta->title = $metaTitle;
    }

    /**
     * @return string|null
     */
    public function getMetaDescriptionAttribute()
    {
        $metaTag = $this->findMetaTag();

        if (!$metaTag) {
            return null;
        }

        return $metaTag->description;
    }

    /**
     * @param $metaDescription
     */
    public function setMetaDescriptionAttribute($metaDescription): void
    {
        $this->createRelationMetaIfNotExist();
        $this->meta->description = $metaDescription;
    }

    /**
     * @return string|null
     */
    public function getMetaKeywordsAttribute()
    {
        $metaTag = $this->findMetaTag();

        if (!$metaTag) {
            return null;
        }

        return $metaTag->keywords;
    }

    /**
     * @param $keywords
     */
    public function setMetaKeywordsAttribute($keywords): void
    {
        $this->createRelationMetaIfNotExist();
        $this->meta->keywords = $keywords;
    }

    /**
     * @return MorphOne
     */
    public function meta()
    {
        return $this->morphOne(MetaTagModel::class, 'entity');
    }

    /**
     * @return bool
     */
    protected function createRelationMetaIfNotExist()
    {
        if (!empty($this->meta)) {
            return false;
        }

        $metaData = [
            'entity_type' => $this->getMorphClass()
        ];

        $this->relations['meta'] = new MetaTagModel($metaData);

        return true;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    private function findMetaTag(): ?MetaTagModel
    {
        return $this->meta;
    }
}
