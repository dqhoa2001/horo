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
        Schema::table('admin_coupons', function (Blueprint $table) {
            $table->boolean('is_personal_appr_enabled')->default(true)->after('use_limit')->comment('個人鑑定にクーポンを使用できるか');
            $table->boolean('is_family_appr_enabled')->default(true)->after('is_personal_appr_enabled')->comment('家族の個人鑑定にクーポンを使用できるか');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_coupons', function (Blueprint $table) {
            $table->dropColumn('is_personal_appr_enabled');
            $table->dropColumn('is_family_appr_enabled');
        });
    }
};
