<?php

namespace App\Common\Setting\Services;

use App\Common\Setting\Models\Setting as SettingModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * Class Setting
 * @package App\Common\Setting\Services
 */
class Setting
{
    /**
     * @var int
     */
    private $cacheTime;

    /**
     * @var Collection
     */
    private $settings;

    /**
     * Setting constructor.
     */
    public function __construct(int $cacheTime)
    {
        $this->cacheTime = $cacheTime;
        $this->settings = $this->getAllSettings();
    }

    /**
     * @return string
     */
    public function getRobots(): string
    {
        return $this->getValueByName('robots');
    }

    /**
     * @return int
     */
    public function getLimitIndexPostsPage(): int
    {
        return (int)$this->getValueByName('limit_index_posts_page');
    }

    /**
     * @return int
     */
    public function getSizePostPreviewContent(): int
    {
        return (int)$this->getValueByName('size_post_preview_content');
    }

    /**
     * @return int
     */
    public function getTimeCachePosts(): int
    {
        return (int)$this->getValueByName('time_cache_posts');
    }

    /**
     * @return int
     */
    public function getTimeCachePages(): int
    {
        return (int)$this->getValueByName('time_cache_pages');
    }

    /**
     * @return Collection
     */
    private function getAllSettings(): Collection
    {
        if ($this->cacheTime === 0) {
            return SettingModel::all();
        }

        return Cache::remember('settings', $this->cacheTime, function () {
            return SettingModel::all();
        });
    }

    /**
     * @param string $name
     * @return null|string
     */
    private function getValueByName(string $name): ?string
    {
        $setting = $this->settings->where('name', $name)->first();
        return $setting instanceof SettingModel ? $setting->value : null;
    }
}