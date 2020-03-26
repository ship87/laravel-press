<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminMenuPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $last = DB::table('admin_menu')
            ->where('parent_id', '=', 0)
            ->orderBy('order', 'DESC')
            ->first();

        DB::table('admin_menu')->insert(
            [
                'title' => 'Posts',
                'icon' => 'fa-bars',
                'order' => $last->order + 1
            ]
        );

        $parent = DB::table('admin_menu')->where('title', 'Posts')->whereNull('uri')->first();

        DB::table('admin_menu')->insert(
            [
                'title' => 'Posts',
                'icon' => 'fa-bars',
                'parent_id' => $parent->id,
                'uri' => 'posts/posts',
                'order' => 1
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
        DB::table('admin_menu')->where('title', 'Posts')->whereNull('uri')->delete();
        DB::table('admin_menu')->where('uri','posts/posts')->delete();
    }
}
