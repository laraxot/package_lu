<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLiveuserRightImpliedTable extends Migration
{
    protected $table='liveuser_right_implied';
    protected $connection='liveuser_general';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $schema=Schema::connection($this->connection);
        if (!$schema->hasTable($this->table)) {
            try {
                $schema->create($this->table, function (Blueprint $table) {
                    $table->increments('id');
                    $table->integer('right_id')->unsigned()->default(0)->index('right_id');
                    $table->integer('implied_right_id')->unsigned()->default(0)->index('implied_right_id');
                    //$table->primary(['right_id','implied_right_id']); //meglio usare id, piu' veloce da far mangiare al crud
                });
            } catch (QueryException $e) {
                dd($e);
            }
        }
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('liveuser_general')->drop($this->table);
    }
}
