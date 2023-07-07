<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignCascadeToPostsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts_categories', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->foreign('post_id')
                ->references('id')->on('posts')
                ->onDelete('cascade');

            $table->dropForeign(['category_id']);
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts_categories', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->foreign('post_id')
                ->references('id')
                ->on('posts');

            $table->dropForeign(['category_id']);
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
        });
    }
}
