<?php

namespace App\Common\Setting\Providers;

use App\Common\Setting\Services\Setting;
use Illuminate\Support\ServiceProvider;

/**
 * Class SettingServiceProvider
 * @package App\Common\Weather\Providers
 */
class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Setting::class, function ($app) {
            return new Setting(
                $app['config']['app.cache_time_settings']
            );
        });
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
