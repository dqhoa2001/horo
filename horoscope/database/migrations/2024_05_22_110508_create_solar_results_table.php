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
        Schema::create('solar_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appraisal_apply_id')->constrained('users')->cascadeOnDelete();
            $table->string('planet_key_name')->comment('惑星のキー名');
            $table->string('planet_symbol')->comment('惑星のシンボル');
            $table->string('planet_name')->comment('惑星の名前');
            $table->string('planet_name_en')->comment('惑星の名前（英語）');
            $table->string('zodiac_pattern_name')->comment('星座の名前（日本語）');
            $table->string('zodiac_pattern_name_en')->comment('星座の名前（英語）');
            $table->text('zodiac_pattern_content')->comment('星座の説明・内容（日本語）');
            $table->text('zodiac_pattern_content_en')->comment('星座の説明・内容（英語）');
            $table->string('house_pattern_name')->comment('ハウス（アストロロジーにおける12のセクター）の名前（日本語）');
            $table->string('house_pattern_name_en')->comment('ハウスの名前（英語）');
            $table->text('house_pattern_content')->comment('ハウスの説明・内容（日本語）');
            $table->text('house_pattern_content_en')->comment('ハウスの説明・内容（英語）');
            $table->string('sabian_pattern_name')->comment('サビアンシンボルの名前（日本語）');
            $table->string('sabian_pattern_name_en')->comment('サビアンシンボルの名前（英語）');
            $table->string('sabian_pattern_sabian_degrees')->comment('サビアンシンボルの度数');
            $table->string('sabian_pattern_title')->comment('サビアンシンボルのタイトル（日本語）');
            $table->string('sabian_pattern_title_en')->comment('サビアンシンボルのタイトル（英語）');
            $table->text('sabian_pattern_content')->comment('サビアンシンボルの説明・内容（日本語）');
            $table->text('sabian_pattern_content_en')->comment('サビアンシンボルの説明・内容（英語）');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solar_results');
    }
};
