<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    'as' => 'client.',
], function () {

    Route::group([
        'namespace' => 'Blog',
        'as' => 'blog.',
    ], function () {
        Route::get('/', 'PostController@index')->name('index');
        Route::get('/page/{page}', 'PostController@index')->name('index-page');
        Route::get('/{slug}', 'PostController@show')->name('show');

        Route::get('/category/{slug}', 'CategoryController@show')->name('category.show');
    });

    Route::group([
        'namespace' => 'Seo',
        'as' => 'seo.',
    ], function () {
        Route::get('/robots.txt', 'SeoController@showRobots')->name('robots');
    });

});
