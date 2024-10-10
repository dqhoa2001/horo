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
        Schema::create('bookbinding_user_applies', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained()->comment('ユーザーID');
            $table->foreignId('appraisal_apply_id')->constrained();
            // $table->string('coupon_code')->nullable()->comment('クーポンコード');
            // $table->integer('price')->comment('金額');
            // $table->integer('point')->nullable()->comment('消費ポイント');
            // $table->integer('discount_amount')->nullable()->comment('値引金額');
            $table->boolean('is_delivery')->default(false)->comment('発送フラグ');
            $table->string('name')->comment('発送先のお名前');
            $table->integer('post_number')->comment('郵便番号');
            $table->string('address')->comment('住所');
            $table->string('tel')->comment('電話番号');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookbinding_user_applies');
    }
};
