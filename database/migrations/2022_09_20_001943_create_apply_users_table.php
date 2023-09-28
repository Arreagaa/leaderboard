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
        Schema::create('apply_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname');
            $table->string('email');
            $table->date('date_of_birth')->nullable();
            $table->string('dpi')->nullable();
            $table->string('sex')->nullable();
            $table->string('phone')->nullable();
            $table->string('name_contact_emergency')->nullable();
            $table->string('phone_contact_emergency')->nullable();
            $table->string('shirt_size')->nullable();
            $table->string('qr')->nullable();
            $table->string('voucher')->nullable();
            $table->string('team_id')->nullable();
            $table->boolean('approved')->nullable();
            $table->string('type')->nullable();

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
        Schema::dropIfExists('apply_users');
    }
};
