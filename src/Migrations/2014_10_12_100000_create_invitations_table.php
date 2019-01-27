<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationsTable extends Migration
{
    protected $table = 'invitations';
    protected $connection = 'liveuser_general';

    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::connection('liveuser_general')->hasTable($this->table)) {
            Schema::connection('liveuser_general')->create($this->table, function (Blueprint $table) {
                $table->increments('id');
                $table->string('email',100)->unique();
                $table->string('invitation_token', 32)->unique()->nullable();
                $table->timestamp('registered_at')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::connection('liveuser_general')->dropIfExists($this->table);
    }
}
