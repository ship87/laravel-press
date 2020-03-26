<?php

namespace App\Common\Sitemap;

use App\Common\Sitemap\Exceptions\FailedCreateDirectorySitemap;
use App\Common\Sitemap\Providers\SitemapProvider;
use XMLWriter;

/**
 * Class SitemapBuilder
 * @package App\Common\Sitemap
 */
class SitemapBuilder
{
    /**
     * XML namespace
     */
    public const XMLNS = 'http://www.sitemaps.org/schemas/sitemap/0.9';

    /**
     * @var SitemapProvider[]
     */
    private $providers = [];

    /**
     * @var string
     */
    private $filesPath;

    /**
     * SitemapBuilder constructor.
     */
    public function __construct()
    {
        $this->filesPath = public_path() . DIRECTORY_SEPARATOR . 'sitemaps' . DIRECTORY_SEPARATOR;
    }

    /**
     * @param  SitemapProvider $provider
     */
    public function addProvider(SitemapProvider $provider)
    {
        $this->providers[$provider->getCode()] = $provider;
    }

    /**
     * @throws FailedCreateDirectorySitemap
     */
    public function save(): void
    {
        if (!file_exists($this->filesPath) && !mkdir($this->filesPath, 0777, true)) {
            throw new FailedCreateDirectorySitemap('Failed to create directory for sitemap');
        }

        $indexFile = public_path() . DIRECTORY_SEPARATOR . 'sitemap.xml.tmp';
        $xml = new XMLWriter();

        $xml->openUri($indexFile);
        $xml->setIndent(true);
        $xml->startDocument('1.0', 'UTF-8');
        $xml->startElement('sitemapindex');
        $xml->writeAttribute('xmlns', self::XMLNS);

        foreach ($this->providers as $code => $provider) {
            if ($file = $this->buildXML($code, $provider->getItems())) {
                rename($file, mb_substr($file, 0, mb_strlen($file) - 4));

                $xml->startElement('sitemap');
                $xml->writeElement('loc', route('main') . '/sitemaps/' . $code . '.xml');
                $xml->endElement();
            }
        }

        $xml->endElement();
        $xml->endDocument();
        $xml->flush();
        unset($xml);

        if (filesize($indexFile)) {
            rename($indexFile, mb_substr($indexFile, 0, mb_strlen($indexFile) - 4));
        }
    }

    /**
     * @param  string $code
     * @param  SitemapItem[] $items
     * @return null|string
     */
    private function buildXML(string $code, array $items)
    {
        if (empty($items)) {
            return null;
        }

        $file = $this->filesPath . $code . '.xml.tmp';
        $xml = new XMLWriter();
        $xml->openUri($file);
        $xml->setIndent(true);
        $xml->startDocument('1.0', 'UTF-8');
        $xml->startElement('urlset');
        $xml->writeAttribute('xmlns', self::XMLNS);

        foreach ($items as $item) {
            $xml->startElement('url');
            $xml->writeElement('loc', $item->loc);
            $xml->writeElement('changefreq', $item->changefreq);
            $xml->writeElement('priority', $item->priority);
            $xml->endElement();
        }

        $xml->endElement();
        $xml->endDocument();
        $xml->flush();
        unset($xml);

        return (filesize($file)) ? $file : null;
    }
}
