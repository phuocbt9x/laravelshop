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
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_user');
            $table->string('address');
            $table->unsignedInteger('city');
            $table->unsignedInteger('district');
            $table->unsignedInteger('ward');
            $table->boolean('activated')->default(0);
            $table->timestamps();
            $table->foreign('id_user')
            ->references('uuid')
            ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
