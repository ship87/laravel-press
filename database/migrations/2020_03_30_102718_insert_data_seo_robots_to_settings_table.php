<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertDataSeoRobotsToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            DB::table('settings')->where('name','robots')->update(
                [
                    'value'=> 'User-agent: *
Disallow: /themes/
Disallow: /vendor/
Disallow: /search/
Disallow: /archive/
Disallow: /tag
Disallow: /category/
Disallow: /page/
Disallow: /feed/
Disallow: /?s=
Disallow: /?

User-agent: Yandex
Disallow: /themes/
Disallow: /vendor/
Disallow: /search/
Disallow: /archive/
Disallow: /tag
Disallow: /category/
Disallow: /page/
Disallow: /feed/
Disallow: /?s=
Disallow: /?
Sitemap: http://laravel-press.com/sitemap.xml
Host: laravel-press.com'
                ]
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            DB::table('settings')->where('name','robots')->update(
                [
                    'value'=> ''
                ]
            );
        });
    }
}
