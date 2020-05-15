<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPreviewCommentCountToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->text('preview_content')->nullable();
            $table->unsignedBigInteger('comment_count')->default(0);
            $table->unsignedBigInteger('comment_published_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('preview_content');
            $table->dropColumn('comment_count');
            $table->dropColumn('comment_published_count');
        });
    }
}
