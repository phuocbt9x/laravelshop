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
        Schema::create('option_products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_product');
            $table->unsignedInteger('id_option');
            $table->unsignedInteger('id_option_value');
            $table->boolean('activated')->default(0);
            $table->timestamps();
            $table->foreign('id_product')->references('id')->on('products');
            $table->foreign('id_option')->references('id')->on('options');
            $table->foreign('id_option_value')->references('id')->on('option_values');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('option_products');
    }
};
