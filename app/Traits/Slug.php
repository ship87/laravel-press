<?php

namespace App\Traits;

use App\Helpers\Url;

/**
 * Trait Slug
 * @package App\Traits
 */
trait Slug
{
    public function setSlugAttribute($slug): void
    {
        if (empty($slug)) {
            $slug = Url::getUniqueSlugForModelCode(
                [static::class],
                'slug',
                $this->title
            );
        }

        $this->attributes['slug'] = $slug;
    }
}
