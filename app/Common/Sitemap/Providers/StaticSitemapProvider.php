<?php

namespace App\Common\Sitemap\Providers;

use App\Common\Sitemap\SitemapItem;

/**
 * Class StaticSitemapProvider
 * @package App\Components\Sitemaps
 */
class StaticSitemapProvider extends SitemapProvider
{
    /**
     * @inheritDoc
     */
    public function getCode(): string
    {
        return 'static';
    }

    /**
     * @inheritDoc
     */
    public function getItems()
    {
        $items = [];

        $routeNames = [
            'main'
        ];

        foreach ($routeNames as $routeName) {
            $items[] = new SitemapItem(['loc' => route($routeName)]);
        }

        return $items;
    }
}
