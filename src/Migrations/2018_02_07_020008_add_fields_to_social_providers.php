<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToSocialProviders extends Migration
{
    protected $table = 'social_providers';

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::connection('liveuser_general')->table($this->table, function (Blueprint $table) {
            if (!Schema::connection('liveuser_general')->hasColumn($this->table, 'token')) {
                $table->string('token')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::connection('liveuser_general')->table($this->table, function (Blueprint $table) {
            //    $table->dropColumn(['guid']);
        });
    }
}
