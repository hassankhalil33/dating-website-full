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
        Schema::create('extended__users', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")
                ->references("id")
                ->on("users")
                ->nullable();
            $table->integer("age")
                ->nullable();
            $table->string("gender", 45);
            $table->string("interested_in", 45);
            $table->string("location", 95);
            $table->string("latitude", 45);
            $table->string("longitude", 45);
            $table->string("biography");
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
        Schema::dropIfExists('extended__users');
    }
};
