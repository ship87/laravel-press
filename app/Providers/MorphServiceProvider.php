<?php

namespace App\Providers;

use App\Common\Page\Models\Page;
use App\Common\Page\Models\Post;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 *
 * Class MorphServiceProvider
 * @package App\Providers
 */
class MorphServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Relation::morphMap([
            1 => Page::class,
            2 => Post::class,
        ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
