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
            $table->increments('id');
            $table->unsignedInteger('id_address');
            $table->string('name');
            $table->string('email');
            $table->string('address');
            $table->string('city');
            $table->string('district');
            $table->string('ward');
            $table->string('note');
            $table->integer('total_item');
            $table->double('total_price');
            $table->unsignedInteger('id_coupon')->nullable();
            $table->double('final_price');
            $table->boolean('activated')->default(0);
            $table->timestamps();
            $table->foreign('id_address')->references('id')->on('addresses');
            $table->foreign('id_coupon')->references('id')->on('coupons');
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
