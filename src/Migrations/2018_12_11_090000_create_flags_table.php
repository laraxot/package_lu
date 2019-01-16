<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFlagsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::connection('liveuser_general')->hasTable('liveuser_flags')) {
            Schema::connection('liveuser_general')->create('liveuser_flags', function (Blueprint $table) {
                $table->increments('flag_id');
                $table->integer('owner_user_id')->unsigned()->nullable();
                $table->string('email', 250)->nullable();
                $table->string('descr', 4096)->nullable()->default('');
                $table->boolean('checked')->nullable()->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::connection('liveuser_general')->drop('liveuser_flags');
    }
}
