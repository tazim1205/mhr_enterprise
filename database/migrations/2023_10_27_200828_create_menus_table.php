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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('label_id')->nullable()->unsigned();
            $table->foreign('label_id')->references('id')->on('menu_labels');
            $table->bigInteger('parent_id')->nullable()->unsigned();
            $table->foreign('parent_id')->references('id')->on('menus');
            $table->string('menu_name_en')->nullable();
            $table->string('menu_name_bn')->nullable();
            $table->string('system_name')->nullable();
            $table->string('route')->nullable();
            $table->string('slug')->nullable();
            $table->integer('order_by')->default('1');
            $table->integer('status')->default('1')->comment(' 1 = Active & 0 = Inactive');
            $table->integer('type')->nullable()->comment(' 1 = Parent , 2 = Module & 3 = Single');
            $table->string('icon',50)->nullable();
            $table->bigInteger('create_by')->nullable()->unsigned();
            $table->foreign('create_by')->references('id')->on('users');
            $table->date('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('menus');
    }
};
