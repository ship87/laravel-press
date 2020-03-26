<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminUsersColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users_columns', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('columns', 2048);
            $table->string('route');
            $table->foreign('user_id')
                ->references('id')
                ->on(config('admin.database.users_table'))
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique(['user_id', 'route']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_users_columns');
    }
}
