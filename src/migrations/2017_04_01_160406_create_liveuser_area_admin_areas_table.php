<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLiveuserAreaAdminAreasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::connection('liveuser_general')->hasTable('liveuser_area_admin_areas')) 
		Schema::connection('liveuser_general')->create('liveuser_area_admin_areas', function(Blueprint $table)
		{
<<<<<<< HEAD
			$table->integer('id', true);
=======
			$table->increments('id');
>>>>>>> master
			$table->integer('area_id')->unsigned()->default(0);
			$table->integer('perm_user_id')->unsigned()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('liveuser_general')->drop('liveuser_area_admin_areas');
	}
<<<<<<< HEAD

=======
>>>>>>> master
}
