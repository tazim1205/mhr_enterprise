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
        Schema::create('menu_restore_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('menu_id')->nullable()->unsigned();
            $table->foreign('menu_id')->references('id')->on('menus');
            $table->date('date')->nulalble();
            $table->string('time')->nullable();
            $table->bigInteger('restore_by')->unsigned();
            $table->foreign('restore_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_restore_histories');
    }
};
