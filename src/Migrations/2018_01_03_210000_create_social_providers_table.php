<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialProvidersTable extends Migration{
    protected $table='social_providers';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        if (!Schema::connection('liveuser_general')->hasTable($this->table)) {
            Schema::connection('liveuser_general')->create($this->table, function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned()->references('auth_user_id')->on('liveuser_users');
                $table->string('provider_id');
                $table->string('provider');
                $table->string('token');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists($this->table);
    }
}
