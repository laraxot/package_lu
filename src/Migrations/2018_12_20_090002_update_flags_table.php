<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateFlagsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::connection('liveuser_general')->hasTable('liveuser_flags')) {
            Schema::connection('liveuser_general')->table('liveuser_flags', function ($table) {
                $table->integer('type')->unsigned();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::connection('liveuser_general')->hasTable('liveuser_flags')) {
            Schema::connection('liveuser_general')->table('liveuser_flags', function ($table) {
                $table->dropColumn('type');
            });
        }
    }
}
