<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToLiveuserAreas extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::connection('liveuser_general')->table('liveuser_areas', function (Blueprint $table) {
            if (!Schema::connection('liveuser_general')->hasColumn('liveuser_areas', 'deleted_by')) {
                $table->string('deleted_by')->nullable();
            }
            if (!Schema::connection('liveuser_general')->hasColumn('liveuser_areas', 'updated_by')) {
                $table->string('updated_by')->nullable();
            }
            if (!Schema::connection('liveuser_general')->hasColumn('liveuser_areas', 'created_by')) {
                $table->string('created_by')->nullable();
            }
            if (!Schema::connection('liveuser_general')->hasColumn('liveuser_areas', 'deleted_at')) {
                $table->softDeletes();
            }
            if (!Schema::connection('liveuser_general')->hasColumns('liveuser_areas', ['updated_at', 'created_at'])) {
                $table->timestamps();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::connection('liveuser_general')->table('liveuser_areas', function (Blueprint $table) {
            $table->dropColumn(['deleted_by', 'updated_by', 'created_by', 'updated_at', 'created_at', 'deleted_at']);
        });
    }
}
