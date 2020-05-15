<?php

namespace App\Common\Blog\Services;

use App\Common\Blog\Models\Post as PostModel;
use App\Common\Setting\Services\Setting as SettingService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

/**
 * Class Post
 * @package App\Common\Post\Services
 */
class Post
{
    /**
     * Post constructor.
     * @param SettingService $settingService
     */
    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * @param $slug
     * @return PostModel|null
     */
    public function getBySlug($slug): ?PostModel
    {
        if ($this->settingService->getTimeCachePosts() === 0) {
            return $this->getBySlugQuery($slug);
        }

        $name = 'posts-index-' . $slug;
        return Cache::remember($name, $this->settingService->getTimeCachePosts(),
            function () use ($slug) {
                return $this->getBySlugQuery($slug);
            });
    }

    /**
     * @param int $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginated(int $page, int $limit): LengthAwarePaginator
    {
        if ($this->settingService->getTimeCachePosts() === 0) {
            return $this->getPaginatedQuery($page, $limit);
        }

        $name = 'posts-index-' . $page . '-' . $limit;
        return Cache::remember($name, $this->settingService->getTimeCachePosts(),
            function () use ($page, $limit) {
                return $this->getPaginatedQuery($page, $limit);
            });
    }

    /**
     * @param $slug
     * @return PostModel|null
     */
    private function getBySlugQuery($slug): ?PostModel
    {
        return PostModel::whereSlug($slug)->first();
    }

    /**
     * @param int $page
     * @param int $limit
     * @return LengthAwarePaginator
     */
    private function getPaginatedQuery(int $page, int $limit): LengthAwarePaginator
    {
        return PostModel::published()
            ->withRelationsPreview()
            ->exclude(['content'])
            ->orderBy('published_at', 'desc')
            ->paginate($limit, ['*'], 'page', $page);
    }
}