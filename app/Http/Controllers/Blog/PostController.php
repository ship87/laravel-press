<?php

namespace App\Http\Controllers\Blog;

use App\Common\Blog\Services\Post as PostService;
use App\Common\Setting\Services\Setting as SettingService;
use App\Http\Controllers\Controller;
use Torann\LaravelMetaTags\Facades\MetaTag;

/**
 * Class PostController
 * @package App\Http\Controllers\Blog
 */
class PostController extends Controller
{
    /**
     * @param PostService $postService
     * @param int $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(SettingService $settingService, PostService $postService, int $page = 1)
    {
        $sizePostPreviewContent = $settingService->getSizePostPreviewContent();
        $limit = $settingService->getLimitIndexPostsPage();
        $posts = $postService->getPaginated($page, $limit);

        MetaTag::set('title', 'LaravelPress');
        MetaTag::set('description', 'LaravelPress is a blog as Wordpress');

        return view('client.themes.default.blog.index', [
            'posts' => $posts,
            'sizePostPreviewContent' => $sizePostPreviewContent,
        ]);
    }

    public function show( PostService $postService, $slug){

        $post=$postService->getBySlug($slug);

        MetaTag::set('title', 'LaravelPress');
        MetaTag::set('description', 'LaravelPress is a blog as Wordpress');

        return view('client.themes.default.blog.show', [
            'post' => $post,
        ]);
    }
}
