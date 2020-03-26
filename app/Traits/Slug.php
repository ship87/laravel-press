<?php

namespace App\Traits;

use App\Helpers\UrlHelper;

/**
 * Trait Slug
 * @package App\Traits
 */
trait Slug
{
    public function setSlugAttribute($slug): void
    {
        if (empty($slug)) {
            $slug = UrlHelper::getUniqueSlugForModelCode(
                [static::class],
                'slug',
                $this->title
            );
        }

        $this->attributes['slug'] = $slug;
    }
}
