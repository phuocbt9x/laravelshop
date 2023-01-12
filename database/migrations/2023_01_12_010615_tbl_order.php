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
            $table->string('name');
            $table->string('email');
            $table->string('address');
            $table->string('city');
            $table->string('district');
            $table->string('ward');
            $table->string('note');
            $table->integer('total_item');
            $table->unsignedDouble('total_price');
            $table->unsignedInteger('coupon_id')->nullable();
            $table->unsignedDouble('final_price');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->foreign('coupon_id')->references('id')->on('coupons');
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
