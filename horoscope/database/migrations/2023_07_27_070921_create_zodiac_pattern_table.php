<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('h_zodiac_patterns', function (Blueprint $table) {
            $table->id();
            $table->integer('zodiac_id');
            $table->integer('planet_id');
            $table->text('content');
            $table->text('content_en');
            $table->boolean('published')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('h_zodiac_patterns');
    }
};
