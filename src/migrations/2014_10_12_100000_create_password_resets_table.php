<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordResetsTable extends Migration
{
    protected $table='password_resets';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('liveuser_general')->hasTable($this->table)) 
        Schema::connection('liveuser_general')->create($this->table, function (Blueprint $table) {
            //$table->increments('id');
            //with index  SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes
            //=> so i add ID increments, remember to test it
            //$table->string('email'); 
            //$table->string('email')->index();
            $table->string('email',191)->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
            //$table->rememberToken();
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('liveuser_general')->dropIfExists($this->table);
    }
}
