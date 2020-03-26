<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminMenuPages extends Migration
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
                'title' => 'Pages',
                'icon' => 'fa-bars',
                'order' => $last->order + 1
            ]
        );

        $parent = DB::table('admin_menu')->where('title', 'Pages')->whereNull('uri')->first();

        DB::table('admin_menu')->insert(
            [
                'title' => 'Pages',
                'icon' => 'fa-bars',
                'parent_id' => $parent->id,
                'uri' => 'pages/pages'
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
        DB::table('admin_menu')->where('title', 'Pages')->whereNull('uri')->delete();
        DB::table('admin_menu')->where('uri','pages/pages')->delete();
    }
}
