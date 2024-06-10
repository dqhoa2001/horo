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
        Schema::table('appraisal_applies', function (Blueprint $table) {
            $table->integer('solar_return')->nullable()->after('reference_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appraisal_applies', function (Blueprint $table) {
            $table->dropColumn('solar_return');
        });
    }
};
