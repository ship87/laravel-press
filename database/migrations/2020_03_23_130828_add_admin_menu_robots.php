<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminMenuRobots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $parent = DB::table('admin_menu')->where('title', 'SEO')->first();

        DB::table('admin_menu')->insert(
            [
                'title' => 'Edit robots.txt',
                'icon' => 'fa-file-text-o',
                'parent_id' => $parent->id,
                'uri' => 'seo/robots'
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('admin_menu')->where('uri','seo/robots')->delete();
    }
}
