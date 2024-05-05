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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('name',200)->nullable();
            $table->string('email',100)->nullable();
            $table->string('phone',11)->nullable();
            $table->text('message')->nullable();
            $table->date('deleted_at')->nullable();
            $table->integer('read')->default('0');
            $table->integer('read_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
