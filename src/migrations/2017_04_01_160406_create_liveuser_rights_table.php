<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLiveuserRightsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::connection('liveuser_general')->hasTable('liveuser_rights')) 
		Schema::connection('liveuser_general')->create('liveuser_rights', function(Blueprint $table)
		{
<<<<<<< HEAD
			$table->integer('right_id')->unsigned()->default(0)->primary();
			$table->integer('area_id')->unsigned()->default(0)->index('rights_area_id');
			$table->string('right_define_name', 250);
=======
			$table->increments('right_id');
			$table->integer('area_id')->unsigned()->default(0)->index('rights_area_id');
			$table->string('right_define_name', 150);
>>>>>>> master
			$table->char('has_implied', 1)->default('N');
			$table->char('has_level', 1)->default('N');
			$table->unique(['area_id','right_define_name'], 'right_define_name');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('liveuser_general')->drop('liveuser_rights');
	}

}
