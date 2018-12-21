<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToSocialProviders extends Migration
{
    protected $table='social_providers';
    /**
     * Run the migrations.
     *
     * @return void
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
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('liveuser_general')->table($this->table, function (Blueprint $table) {
            //    $table->dropColumn(['guid']);
        });
    }
}
