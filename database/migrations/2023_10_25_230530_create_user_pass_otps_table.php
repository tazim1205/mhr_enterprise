<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_pass_otps', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->integer('otp')->default('123456');
            $table->text('session_id')->nullable();
            $table->integer('verified')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_pass_otps');
    }
};
