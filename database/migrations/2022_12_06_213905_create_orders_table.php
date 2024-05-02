<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->decimal('sub_total', 10,2);
            $table->decimal('total', 10,2);
            $table->string('location')->nullable();
            $table->string('new_location')->nullable();
            $table->integer('status')->default(4);
            $table->integer('delivery_status')->default(0);
            $table->text('special_instruction')->nullable();
            $table->integer('food_center_id');
            $table->integer('assignee')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
