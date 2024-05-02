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
        //
        Schema::table('users', function (Blueprint $table) {
            $table->string('location');
            $table->string('phone_number')->unique();
            $table->text('image')->nullable();
            $table->string('next_of_kin_name')->nullable();
            $table->string('next_of_kin_phone_number')->unique()->nullable();
            $table->integer('user_type')->default(0);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('location');
            $table->dropColumn('phone_number');
            $table->dropColumn('image');
            $table->dropColumn('next_of_kin_name');
            $table->dropColumn('next_of_kin_phone_number');
            $table->dropColumn('user_type');
            
        });
    }
};
