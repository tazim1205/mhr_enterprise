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
        Schema::create('menu_actions', function (Blueprint $table) {
            $table->id();
            $table->string('name_en',150)->nullable();
            $table->string('name_bn',150)->nullable();
            $table->string('system_name',150)->nullable();
            $table->string('slug',150)->nullable();
            $table->integer('status')->default(1)->comment(' 1 = Active & 0 = Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_actions');
    }
};
