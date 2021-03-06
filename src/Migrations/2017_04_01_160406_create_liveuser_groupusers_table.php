<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLiveuserGroupusersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::connection('liveuser_general')->hasTable('liveuser_groupusers')) {
            Schema::connection('liveuser_general')->create('liveuser_groupusers', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('perm_user_id')->unsigned()->default(0)->index('perm_user_id');
                $table->integer('group_id')->unsigned()->default(0)->index('group_id');
                //$table->primary(['group_id','perm_user_id']); //meglio mettere id, piu' veloce da far mangiare al crud
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::connection('liveuser_general')->drop('liveuser_groupusers');
    }
}
