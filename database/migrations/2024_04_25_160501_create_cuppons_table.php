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
        Schema::create('cuppons', function (Blueprint $table) {
            $table->id();
            $table->string('cuppon_code')->default('FENI20');
            $table->double('discount_amount',11,2)->default('0.00');
            $table->timestamp('expire_date')->default(null)->nullable();
            $table->integer('status')->default('1');
            $table->date('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuppons');
    }
};
