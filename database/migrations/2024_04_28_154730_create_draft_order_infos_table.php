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
        Schema::create('draft_order_infos', function (Blueprint $table) {
            $table->id();
            $table->text('session_id')->nullable();
            $table->double('total',11,2)->nullable();
            $table->double('shipping_cost',11,2)->nullable();
            $table->double('cuppon_amount',11,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('draft_order_infos');
    }
};
