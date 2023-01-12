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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('uuid');
            $table->string('fullname');
            $table->boolean('gender')->default(0);
            $table->date('birthdate');
            $table->unsignedInteger('id_login');
            $table->string('image');
            $table->timestamps();
            $table->foreign('id_login')
                ->references('id')
                ->on('logins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
