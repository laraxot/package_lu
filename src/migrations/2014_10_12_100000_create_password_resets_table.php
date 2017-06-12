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
<<<<<<< HEAD
        if (!Schema::connection('liveuser_general')->hasTable($this->table))
=======
        if (!Schema::connection('liveuser_general')->hasTable($this->table)) 
>>>>>>> f275b5801e7fa85d2df2d6b07d2c5d92b0ee86e2
        Schema::connection('liveuser_general')->create($this->table, function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
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
