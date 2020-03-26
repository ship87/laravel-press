<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
    'as' => 'admin.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');

    Route::namespace('Seo')->prefix('seo')->group(
        function () use ($router) {

            $router->resource('robots', 'RobotsController');
        }
    );

    Route::namespace('Page')->prefix('pages')->group(
        function () use ($router) {

            $router->resource('pages', 'PageController');
            $router->resource('pages_comments', 'PageCommentController');
        }
    );

    Route::namespace('Post')->prefix('posts')->group(
        function () use ($router) {

            $router->resource('posts', 'PostController');
            $router->resource('categories', 'CategoryController');
            $router->resource('tags', 'TagController');
            $router->resource('posts_comments', 'PostCommentController');
        }
    );
});
