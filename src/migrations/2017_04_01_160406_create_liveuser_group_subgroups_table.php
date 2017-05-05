<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLiveuserGroupSubgroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::connection('liveuser_general')->hasTable('liveuser_group_subgroups')) 
		Schema::connection('liveuser_general')->create('liveuser_group_subgroups', function(Blueprint $table)
		{
<<<<<<< HEAD
			$table->integer('group_id')->unsigned()->default(0)->index('group_id');
			$table->integer('subgroup_id')->unsigned()->default(0)->index('subgroup_id');
			$table->primary(['group_id','subgroup_id']);
=======
			$table->increments('id');
			$table->integer('group_id')->unsigned()->default(0)->index('group_id');
			$table->integer('subgroup_id')->unsigned()->default(0)->index('subgroup_id');
			//$table->primary(['group_id','subgroup_id']); //meglio usare id, piu' veloce per il crud
>>>>>>> master
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('liveuser_general')->drop('liveuser_group_subgroups');
	}

}
