<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLiveuserPermUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::connection('liveuser_general')->hasTable('liveuser_perm_users')) {
            Schema::connection('liveuser_general')->create('liveuser_perm_users', function (Blueprint $table) {
                $table->increments('perm_user_id');
                $table->integer('auth_user_id')->default(0);
                $table->integer('perm_type')->unsigned()->nullable();
                $table->string('auth_container_name', 32)->default('');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::connection('liveuser_general')->drop('liveuser_perm_users');
    }
}
