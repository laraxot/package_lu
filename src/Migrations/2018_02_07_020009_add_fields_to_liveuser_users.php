<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToLiveuserUsers extends Migration{
   protected $table='liveuser_users';
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::connection('liveuser_general')->table($this->table, function (Blueprint $table) {
			if (!Schema::connection('liveuser_general')->hasColumn($this->table, 'last_login_at')) {
				 $table->datetime('last_login_at')->nullable();
			};
			if (!Schema::connection('liveuser_general')->hasColumn($this->table, 'last_login_ip')) {
				 $table->string('last_login_ip')->nullable();
			};
			if (!Schema::connection('liveuser_general')->hasColumn($this->table, 'firstname')) {
				 $table->string('firstname')->nullable();
			};
			if (!Schema::connection('liveuser_general')->hasColumn($this->table, 'surname')) {
				 $table->string('surname')->nullable();
			};
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::connection('liveuser_general')->table($this->table, function (Blueprint $table) {
		//    $table->dropColumn(['guid']);
		});
	}
}
