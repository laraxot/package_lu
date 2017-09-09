<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimestampsToLiveUserPermuser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('liveuser_general')->table('liveuser_perm_users', function (Blueprint $table) {
            if (!Schema::connection('liveuser_general')->hasColumn('liveuser_perm_users', 'deleted_by')) {
                $table->string('deleted_by')->nullable();
            }
            if (!Schema::connection('liveuser_general')->hasColumn('liveuser_perm_users', 'updated_by')) {
                $table->string('updated_by')->nullable();
            }
            if (!Schema::connection('liveuser_general')->hasColumn('liveuser_perm_users', 'created_by')) {
                $table->string('created_by')->nullable();
            }
            if (!Schema::connection('liveuser_general')->hasColumn('liveuser_perm_users', 'deleted_at')) {
                $table->softDeletes();
            }
            if (!Schema::connection('liveuser_general')->hasColumns('liveuser_perm_users', ['updated_at', 'created_at'])) {
                $table->timestamps();
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
        Schema::connection('liveuser_general')->table('liveuser_perm_users', function (Blueprint $table) {
            $table->dropColumn(['deleted_by', 'updated_by', 'created_by', 'updated_at', 'created_at', 'deleted_at']);
        });
    }
}
