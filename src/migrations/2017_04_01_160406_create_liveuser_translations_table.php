<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLiveuserTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::connection('liveuser_general')->hasTable('liveuser_translations')) 
		Schema::connection('liveuser_general')->create('liveuser_translations', function(Blueprint $table)
		{
<<<<<<< HEAD
=======
			$table->increments('id');
>>>>>>> master
			$table->integer('section_id')->unsigned()->default(0);
			$table->boolean('section_type')->default(0);
			$table->string('language_id', 2)->default('');
			$table->string('name', 50)->default('');
			$table->string('description')->nullable();
<<<<<<< HEAD
			$table->primary(['section_id','section_type','language_id']);
=======
			//$table->primary(['section_id','section_type','language_id']);//meglio usare id piu' veloce da far mangiare al crud
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
		Schema::connection('liveuser_general')->drop('liveuser_translations');
	}

}
