<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLiveuserGrouprightsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('liveuser_general')->hasTable('liveuser_grouprights')) {
            Schema::connection('liveuser_general')->create('liveuser_grouprights', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('group_id')->unsigned()->default(0);
                $table->integer('right_id')->unsigned()->default(0);
                $table->boolean('right_level')->nullable()->default(3);
                //$table->primary(['group_id','right_id']);//meglio usare id..
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
        Schema::connection('liveuser_general')->drop('liveuser_grouprights');
    }
}
