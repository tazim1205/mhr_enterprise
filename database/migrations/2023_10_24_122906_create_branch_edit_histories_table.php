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
        Schema::create('branch_edit_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('branch_id')->nullable()->unsigned();
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->date('date')->nullable();
            $table->string('time')->nullable();
            $table->bigInteger('edit_by')->nullble()->unsigned();
            $table->foreign('edit_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_edit_histories');
    }
};
