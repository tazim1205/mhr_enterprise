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
        Schema::create('about_uses', function (Blueprint $table) {
            $table->id();
            $table->string('title_en',200)->default('about_english');
            $table->string('title_bn',200)->default('about_bangla');
            $table->longtext('description');
            $table->string('image',50)->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_uses');
    }
};
