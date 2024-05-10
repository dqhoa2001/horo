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
            $table->string('file_name')->nullable()->comment('FTPサーバー上のファイル名')->after('is_design');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookbinding_user_applies', function (Blueprint $table) {
            $table->dropColumn('file_name');
        });
    }
};
