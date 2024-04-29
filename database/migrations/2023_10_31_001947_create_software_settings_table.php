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
        Schema::create('software_settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo',100)->default('0');
            $table->string('favicon',100)->default('0');
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();
            $table->text('meta_tag')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('software_settings');
    }
};
