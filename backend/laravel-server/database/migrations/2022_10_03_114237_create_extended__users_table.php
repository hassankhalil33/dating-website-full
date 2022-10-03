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
            $table->integer("age");
            $table->string("gender", 45);
            $table->string("interested_in", 45);
            $table->string("location", 95);
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
