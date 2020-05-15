<?php

use Illuminate\Database\Migrations\Migration;

class InsertSettingsTableIndexPostsLimitPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('settings')->insert(
            [
                'name' => 'limit_index_posts_page',
                'value'=> '5'
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
        DB::table('settings')->where('name', 'limit_index_posts_page')->delete();
    }
}
