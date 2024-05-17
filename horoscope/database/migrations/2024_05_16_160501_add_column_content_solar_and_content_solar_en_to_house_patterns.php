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
        Schema::table('h_house_patterns', function (Blueprint $table) {
            $table->text('content_solar');
            $table->string('content_solar_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('h_house_patterns', function (Blueprint $table) {
            $table->dropColumn('content_solar');
            $table->dropColumn('content_solar_en');
        });
    }
};
