<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply_user_class_team', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apply_user_id')->constrained('apply_users');
            $table->foreignId('clase_team_id')->constrained('clase_teams');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apply_users_class_team');
    }
};
