<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', static function (Blueprint $table) {
            $table->id();
            $table->string('name1')->comment('姓');
            $table->string('name2')->comment('名');
            $table->string('kana1')->comment('セイ');
            $table->string('kana2')->comment('メイ');
            $table->string('email')->unique()->comment('メールアドレス');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('memo')->nullable()->comment('メモ');
            $table->date('birthday')->nullable()->comment('生年月日');
            $table->time('birthday_time')->nullable()->comment('誕生時間');
            $table->string('birthday_prefectures')->nullable()->comment('出生_都道府県');
            $table->string('birthday_city')->nullable()->comment('出生_市区町村');
            $table->string('welcome_code')->nullable()->unique()->comment('招待コード');
            $table->string('longitude')->nullable()->comment('経度');
            $table->string('latitude')->nullable()->comment('緯度');
            $table->integer('timezome')->nullable()->comment('タイムゾーン');
            $table->integer('point_sum')->default(0)->comment('残高ポイント');
            $table->boolean('is_line_popup')->default(true)->comment('LINEポップ 0:非表示, 1:表示');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
