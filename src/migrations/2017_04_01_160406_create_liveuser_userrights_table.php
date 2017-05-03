<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLiveuserUserrightsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::connection('liveuser_general')->hasTable('liveuser_userrights')) 
		Schema::connection('liveuser_general')->create('liveuser_userrights', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('perm_user_id')->unsigned()->default(0)->index('perm_user_id');
			$table->integer('right_id')->unsigned()->default(0)->index('right_id');
			$table->boolean('right_level')->nullable()->default(3);
			//$table->primary(['right_id','perm_user_id']);/// meglio usare id, piu' veloce per il crud
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('liveuser_general')->drop('liveuser_userrights');
	}

}
