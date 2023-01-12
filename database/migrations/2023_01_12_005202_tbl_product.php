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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->double('price');
            $table->string('thumbnail');
            $table->integer('quantity')->nullable();
            $table->string('decrisption');
            $table->unsignedInteger('id_manufacturer');
            $table->unsignedInteger('id_category');
            $table->boolean('activated')->default(0);
            $table->timestamps();
            $table->foreign('id_manufacturer')->references('id')->on('manufactureres');
            $table->foreign('id_category')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
