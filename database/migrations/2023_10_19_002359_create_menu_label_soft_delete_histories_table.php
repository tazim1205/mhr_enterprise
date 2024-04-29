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
        Schema::create('menu_label_soft_delete_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('menu_label_id')->nullable()->unsigned();
            $table->foreign('menu_label_id')->references('id')->on('menu_labels');
            $table->date('date')->nullable();
            $table->string('time')->nullable();
            $table->bigInteger('delete_by')->unsigned();
            $table->foreign('delete_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_label_soft_delete_histories');
    }
};
