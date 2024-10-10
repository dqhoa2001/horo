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
        Schema::table('bookbindings', function (Blueprint $table) {
            $table->boolean('solar_return')->nullable()->after('is_enabled')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookbindings', function (Blueprint $table) {
            $table->dropColumn('solar_return');
        });
    }
};
