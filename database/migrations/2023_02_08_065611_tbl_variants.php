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
        Schema::create('variants',function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->string('sku_id');
            $table->unsignedInteger('option_id');
            $table->unsignedInteger('option_value_id');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('sku_id')->references('sku')->on('product_skus');
            $table->foreign('option_id')->references('id')->on('options');
            $table->foreign('option_value_id')->references('id')->on('option_values');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variants');
    }
};
