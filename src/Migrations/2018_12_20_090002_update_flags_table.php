<?php



use Illuminate\Database\Migrations\Migration;

class UpdateFlagsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (Schema::connection('liveuser_general')->hasTable('liveuser_flags')) {
            Schema::connection('liveuser_general')->table('liveuser_flags', function ($table) {
                $table->integer('type')->unsigned();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        if (Schema::connection('liveuser_general')->hasTable('liveuser_flags')) {
            Schema::connection('liveuser_general')->table('liveuser_flags', function ($table) {
                $table->dropColumn('type');
            });
        }
    }
}
