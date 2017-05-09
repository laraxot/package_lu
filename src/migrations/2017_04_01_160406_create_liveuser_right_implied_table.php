<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLiveuserRightImpliedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::connection('liveuser_general')->hasTable('liveuser_right_implied')) 
		Schema::connection('liveuser_general')->create('liveuser_right_implied', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('right_id')->unsigned()->default(0)->index('right_id');
			$table->integer('implied_right_id')->unsigned()->default(0)->index('implied_right_id');
			//$table->primary(['right_id','implied_right_id']); //meglio usare id, piu' veloce da far mangiare al crud
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('liveuser_general')->drop('liveuser_right_implied');
	}

}
