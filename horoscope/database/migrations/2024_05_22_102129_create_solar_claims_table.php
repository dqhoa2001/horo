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
        Schema::create('solar_claims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('solar_apply_id');
            $table->string('payment_intent_id')->nullable()->comment('支払いID');
            $table->integer('price')->comment('支払い金額');
            $table->string('coupon_code')->nullable()->comment('クーポンコード');
            $table->integer('discount_price')->nullable()->comment('クーポンコードもしくはクーポンによる値引金額');
            $table->date('purchase_date')->comment('購入日');
            $table->tinyInteger('payment_type')->comment('支払方法');
            $table->tinyInteger('content_type')->comment('購入内容');
            $table->boolean('is_paid')->comment('支払いフラグ');
            $table->date('paid_at')->nullable()->comment('支払日');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solar_claims');
    }
};
