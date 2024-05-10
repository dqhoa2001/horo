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
            $table->integer('pref_num')->nullable()->comment('都道府県番号')->after('post_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookbinding_user_applies', function (Blueprint $table) {
            $table->dropColumn('pref_num');
        });
    }
};
