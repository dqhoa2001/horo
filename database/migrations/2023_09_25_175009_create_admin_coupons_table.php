<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin_coupons', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('coupon_name')->comment('クーポン名');
            $table->string('coupon_code')->comment('クーポンコード');
            $table->integer('coupon_price')->comment('ポイント');
            $table->integer('back_point')->comment('バックポイント');
            $table->integer('time_limit')->comment('使用日数');
            $table->date('time_limit_day')->comment('使用期限');
            $table->integer('use_limit')->comment('使用回数');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_coupons');
    }
};
