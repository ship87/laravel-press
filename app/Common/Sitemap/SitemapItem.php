<?php

namespace App\Common\Sitemap;

/**
 * Class SitemapItem
 * @package App\Common\Sitemap
 */
class SitemapItem
{
    /**
     * @var string
     */
    const DATE_FORMAT = 'Y-m-d\TH:i:sP';

    /**
     * @var string
     */
    public $loc;

    /**
     * @var string
     */
    public $changefreq = 'monthly';

    /**
     * @var string
     */
    public $priority = '1';

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            foreach ($data as $name => $value) {
                if (property_exists($this, $name) && !empty($value)) {
                    $this->$name = $value;
                }
            }
        }
    }
}
