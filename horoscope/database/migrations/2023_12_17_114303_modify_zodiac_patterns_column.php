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
        Schema::table('h_zodiac_patterns', function (Blueprint $table) {
            $table->string('content_en')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('h_zodiac_patterns', function (Blueprint $table) {
            $table->string('content_en')->change();
        });
    }
};
