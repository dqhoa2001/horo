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
        Schema::table('h_planets', function (Blueprint $table) {
            $table->string('year_range')->nullable()->comment('歳の範囲')->after('symbol');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('h_planets', function (Blueprint $table) {
            $table->dropColumn('year_range');
        });
    }
};
