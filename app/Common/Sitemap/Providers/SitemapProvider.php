<?php

namespace App\Common\Sitemap\Providers;

use App\Common\Sitemap\SitemapItem;

/**
 * Class SitemapProvider
 * @package App\Common\Sitemap\Providers
 */
abstract class SitemapProvider
{
    /**
     * @return string
     */
    abstract public function getCode(): string;

    /**
     * @return SitemapItem[]
     */
    abstract public function getItems();
}
