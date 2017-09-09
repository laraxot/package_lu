<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLiveuserUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('liveuser_general')->hasTable('liveuser_users')) {
            Schema::connection('liveuser_general')->create('liveuser_users', function (Blueprint $table) {
                $table->increments('auth_user_id');
                $table->string('handle', 32)->nullable()->default('')->index('handle');
                $table->string('passwd', 32)->nullable()->default('');
                $table->dateTime('lastlogin')->nullable();
                $table->integer('owner_user_id')->unsigned()->nullable();
                $table->integer('owner_group_id')->unsigned()->nullable();
                $table->char('is_active', 1)->nullable()->default('N');
                $table->string('email', 250)->nullable();
                $table->boolean('group_id')->nullable()->default(0);
                $table->boolean('banned_id')->nullable()->default(0);
                $table->boolean('country_id')->nullable()->default(0);
                $table->integer('question_id')->unsigned()->nullable()->default(0);
                $table->string('nome', 90)->nullable();
                $table->string('cognome', 50)->nullable()->default('');
                //$table->string('first_name'); //sarebbe meglio tradurre tutti i campi in inglese
                //$table->string('last_name');
                $table->integer('ente')->unsigned()->nullable()->index('i_ente');
                $table->integer('matr')->unsigned()->nullable()->index('i_matr');
                $table->integer('stabi')->nullable();
                $table->integer('repar')->nullable();
                $table->string('password', 40)->nullable()->default('');
                $table->string('hash', 40)->nullable()->default('');
                $table->string('activation_code', 40)->nullable()->default('0');
                $table->string('forgotten_password_code', 40)->nullable()->default('0');
                $table->string('provincia', 2)->nullable()->default('');
                $table->string('conosciuto', 50)->nullable();
                $table->string('news', 10)->nullable();
                $table->string('citta', 100)->nullable()->default('');
                $table->boolean('segno')->nullable()->default(0);
                $table->boolean('hmail')->nullable()->default(0);
                $table->boolean('bounce')->nullable()->default(0);
                $table->timestamp('dataIscrizione')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->integer('dataCancellazione')->nullable()->default(0);
                //$table->string('remember_token', 100)->nullable()->default('0'); //riga sotto dovrebbe fare la stessa cosa
                $table->rememberToken();
                //$table->dateTime('updated_at')->nullable(); //riga sotto dovrebbe fare la stessa cosa
                $table->timestamps();
                $table->index(['ente','matr'], 'i_ente_matr');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('liveuser_general')->drop('liveuser_users');
    }
}
