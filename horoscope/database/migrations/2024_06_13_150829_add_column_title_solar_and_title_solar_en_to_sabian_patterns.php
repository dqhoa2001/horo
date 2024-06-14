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
        Schema::table('h_sabian_patterns', function (Blueprint $table) {
            $table->string('title_solar')->after('updated_at');
            $table->string('title_solar_en')->nullable()->after('title_solar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('h_sabian_patterns', function (Blueprint $table) {
            $table->dropColumn('title_solar');
            $table->dropColumn('title_solar_en');
        });
    }
};
