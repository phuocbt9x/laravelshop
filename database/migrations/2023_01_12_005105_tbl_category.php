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
        Schema::create('categories', function (Blueprint $table) {
<<<<<<< HEAD
            $table->increments('id');
=======
            $table->uuid('id')->primary();
>>>>>>> 82edb61a81b73388b01153b93337f1a90e44977b
            $table->string('name');
            $table->string('slug');
            $table->foreignUuid('parent_id')->nullable();
            $table->boolean('activated')->default(0);
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
        Schema::dropIfExists('categories');
    }
};
