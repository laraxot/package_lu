<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLiveuserAreasTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::connection('liveuser_general')->hasTable('liveuser_areas')) {
            Schema::connection('liveuser_general')->create('liveuser_areas', function (Blueprint $table) {
                $table->increments('area_id');
                $table->integer('application_id')->unsigned()->default(0);
                $table->string('area_define_name', 32)->default('');
                $table->string('db', 32)->default('');
                $table->string('img', 250)->default('0');
                $table->string('icons', 250)->default('0');
                $table->integer('ordine')->default(0);
                $table->string('controller_path')->default('0');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::connection('liveuser_general')->drop('liveuser_areas');
    }
}
