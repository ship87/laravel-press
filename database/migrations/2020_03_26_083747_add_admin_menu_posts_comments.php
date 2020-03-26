<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminMenuPostsComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $parent = DB::table('admin_menu')->where('title', 'Posts')->whereNull('uri')->first();

        DB::table('admin_menu')->insert(
            [
                'title' => 'Posts comments',
                'icon' => 'fa-bars',
                'parent_id' => $parent->id,
                'uri' => 'posts/posts_comments',
                'order' => 4
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
        DB::table('admin_menu')->where('uri', 'posts/posts_comments')->delete();
    }
}
