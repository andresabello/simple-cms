<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePageIdToModelIdInRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rows', function (Blueprint $table) {
            $table->dropForeign(['page_id']);
            $table->renameColumn('page_id', 'model_id');
            $table->string('model_type')->default('Piboutique\\\SimpleCMS\\\Models\\\Page')->after('page_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rows', function (Blueprint $table) {
            $table->renameColumn('model_id', 'page_id');
            $table->dropColumn('model_type');
            $table->foreign('page_id')->references('id')->on('pages');
        });
    }
}
