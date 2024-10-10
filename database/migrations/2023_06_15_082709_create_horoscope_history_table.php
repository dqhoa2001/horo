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
        Schema::create('h_histories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('year');
            $table->string('month');
            $table->string('day');
            $table->integer('longitude');
            $table->integer('latitude');
            $table->double('timezone');
            $table->softDeletes();
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
        Schema::dropIfExists('h_histories');
    }
};
