<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLiveuserGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::connection('liveuser_general')->hasTable('liveuser_groups')) 
		Schema::connection('liveuser_general')->create('liveuser_groups', function(Blueprint $table)
		{
			$table->integer('group_id')->unsigned()->default(0)->primary();
			$table->integer('group_type')->unsigned()->nullable()->default(1);
			$table->string('group_define_name', 250)->nullable()->unique('group_define_name');
			$table->integer('owner_user_id')->unsigned()->nullable();
			$table->integer('owner_group_id')->unsigned()->nullable();
			$table->char('is_active', 1)->default('N');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('liveuser_general')->drop('liveuser_groups');
	}

}