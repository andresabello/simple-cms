<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAltAndCationsToImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->string('alt')->nullable()->after('url');
            $table->text('caption')->nullable()->after('alt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('images')) {
            Schema::table('images', function (Blueprint $table) {
                $table->dropColumn('alt');
                $table->dropColumn('caption');
            });
        }
    }
}
