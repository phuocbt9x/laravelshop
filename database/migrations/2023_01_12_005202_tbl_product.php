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
            $table->string('slug');
            $table->unsignedDouble('price');
            $table->string('thumbnail');
            $table->integer('quantity')->nullable();
            $table->longText('decrisption');
            $table->unsignedInteger('manufacturer_id');
            $table->uuid('category_id');
            $table->boolean('activated')->default(0);
            $table->timestamps();
            $table->foreign('manufacturer_id')->references('id')->on('manufactures');
            $table->foreign('category_id')->references('id')->on('categories');
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
