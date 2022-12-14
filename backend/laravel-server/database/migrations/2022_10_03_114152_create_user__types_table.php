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
        Schema::create('user__types', function (Blueprint $table) {
            $table->id();
            $table->string("type", 45);
            $table->timestamps();
        });

        DB::table('user__types')->insert([
                'type' => 'admin'
        ]);

        DB::table('user__types')->insert([
            'type' => 'user'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user__types');
    }
};
