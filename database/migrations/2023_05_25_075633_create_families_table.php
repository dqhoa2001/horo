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
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('relationship')->comment('続柄');
            $table->string('name1')->comment('家族名（姓）');
            $table->string('name2')->comment('家族名（名）');
            $table->date('birthday')->nullable()->comment('生年月日');
            $table->time('birthday_time')->nullable()->comment('誕生時間');
            $table->string('birthday_prefectures')->nullable()->comment('出生_都道府県');
            $table->string('birthday_city')->nullable()->comment('出生_市区町村');
            $table->string('longitude')->nullable()->comment('経度');
            $table->string('latitude')->nullable()->comment('緯度');
            $table->integer('timezome')->nullable()->comment('タイムゾーン');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('families');
    }
};
