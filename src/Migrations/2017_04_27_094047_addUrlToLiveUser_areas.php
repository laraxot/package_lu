<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUrlToLiveUserAreas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('liveuser_general')->table('liveuser_areas', function (Blueprint $table) {
            if (!Schema::connection('liveuser_general')->hasColumn('liveuser_areas', 'url')) {
                $table->string('url')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('liveuser_general')->table('liveuser_areas', function (Blueprint $table) {
            $table->dropColumn(['url']);
        });
    }
}
