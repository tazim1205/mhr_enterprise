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
        Schema::create('menu_labels', function (Blueprint $table) {
            $table->id();
            $table->string('label_name_en')->nullable();
            $table->string('label_name_bn')->nullable();
            $table->integer('order_by')->default(1);
            $table->bigInteger('create_by')->nullable()->unsigned();
            $table->foreign('create_by')->references('id')->on('users');
            $table->bigInteger('edit_by')->nullable()->unsigned();
            $table->foreign('edit_by')->references('id')->on('users');
            $table->bigInteger('delete_by')->nullable()->unsigned();
            $table->foreign('delete_by')->references('id')->on('users');
            $table->bigInteger('restore_by')->nullable()->unsigned();
            $table->foreign('restore_by')->references('id')->on('users');
            $table->date('deleted_at')->nullable();
            $table->integer('status')->default(1)->comment('1 = Active & 0 = Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_labels');
    }
};
