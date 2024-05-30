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
        Schema::create('solar_bookbinding_user_applies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solar_apply_id')->constrained();
            $table->string('bookbinding_name1')->nullable()->comment('製本に表示する性');
            $table->string('bookbinding_name2')->nullable()->comment('製本に表示する名');
            $table->string('bulk_binding_key')->nullable();
            $table->unsignedInteger('bulk_binding_count')->nullable()->comment('一括製本数');
            $table->boolean('sended_mail')->nullable()->comment('メール送信済みかどうか');
            $table->string('bookbinding_name')->nullable()->comment('製本に表示する名前');
            $table->boolean('is_delivery')->default(false)->comment('発送フラグ');
            $table->string('name')->comment('発送先のお名前');
            $table->string('post_number')->comment('郵便番号');
            $table->integer('pref_num')->nullable()->comment('都道府県番号');
            $table->string('address')->comment('住所');
            $table->string('building')->nullable()->comment('建物名');
            $table->string('tel')->comment('電話番号');
            $table->integer('is_design')->nullable()->comment('表紙の種類');
            $table->string('file_name')->nullable()->comment('FTPサーバー上のファイル名');
            $table->integer('order_id')->nullable()->comment('注文ID');
            $table->integer('purchase_amount')->nullable()->comment('購入金額');
            $table->date('scheduled_shipping_date')->nullable()->comment('発送予定日');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solar_bookbinding_user_applies');
    }
};
