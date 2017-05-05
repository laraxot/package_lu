<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLiveuserApplicationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::connection('liveuser_general')->hasTable('liveuser_applications')) 
		Schema::connection('liveuser_general')->create('liveuser_applications', function(Blueprint $table)
		{
<<<<<<< HEAD
			$table->integer('application_id')->unsigned()->default(0)->primary();
=======
			$table->increments('application_id');
>>>>>>> master
			$table->string('application_define_name', 32)->default('')->unique('application_define_name');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('liveuser_general')->drop('liveuser_applications');
	}

}
