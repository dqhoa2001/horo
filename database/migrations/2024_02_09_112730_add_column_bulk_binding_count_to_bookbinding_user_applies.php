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
        Schema::table('bookbinding_user_applies', function (Blueprint $table) {
            $table->unsignedInteger('bulk_binding_count')->nullable()->comment('一括製本数')->after('bulk_binding_key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookbinding_user_applies', function (Blueprint $table) {
            $table->dropColumn('bulk_binding_count');
        });
    }
};
