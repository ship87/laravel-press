<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminMenuPagesComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $parent = DB::table('admin_menu')->where('title', 'Pages')->whereNull('uri')->first();

        DB::table('admin_menu')->insert(
            [
                'title' => 'Pages comments',
                'icon' => 'fa-bars',
                'parent_id' => $parent->id,
                'uri' => 'pages/pages_comments',
                'order' => 2
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
        DB::table('admin_menu')->where('uri', 'pages/pages_comments')->delete();
    }
}
