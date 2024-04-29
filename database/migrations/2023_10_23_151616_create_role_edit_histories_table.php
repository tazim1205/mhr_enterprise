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
        Schema::create('role_edit_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('role_id')->nullable()->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->date('date')->nulalble();
            $table->string('time')->nullable();
            $table->bigInteger('edit_by')->unsigned();
            $table->foreign('edit_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_edit_histories');
    }
};
