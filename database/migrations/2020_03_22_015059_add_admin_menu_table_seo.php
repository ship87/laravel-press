<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminMenuTableSeo extends Migration
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
                'title' => 'SEO',
                'icon' => 'fa-bars',
                'order' => $last->order + 1
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
        DB::table('admin_menu')->where('title', 'SEO')->delete();
    }
}
