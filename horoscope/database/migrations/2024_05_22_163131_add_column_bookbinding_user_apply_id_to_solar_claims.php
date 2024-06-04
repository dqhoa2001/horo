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
        Schema::table('solar_claims', function (Blueprint $table) {
            $table->unsignedBigInteger('bookbinding_user_apply_id')->nullable()->after('solar_apply_id');
            // $table->foreign('bookbinding_user_apply_id')->references('id')->on('bookbinding_user_applies')->onDelete('cascade');
            $table->foreign('bookbinding_user_apply_id')->references('id')->on('solar_bookbinding_user_applies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('solar_claims', function (Blueprint $table) {
            $table->dropForeign('solar_claims_bookbinding_user_apply_id_foreign');
            $table->dropColumn('bookbinding_user_apply_id');
        });
    }
};
