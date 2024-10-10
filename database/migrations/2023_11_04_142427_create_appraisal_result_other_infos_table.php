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
        Schema::create('appraisal_result_other_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appraisal_result_id')->constrained('appraisal_results')->cascadeOnDelete();
            $table->string('from_planet_symbol')->comment('関係の始点となる惑星のシンボル');
            $table->string('aspect_symbol')->comment('アスペクト（天体同士の角度的な関係）のシンボル');
            $table->string('to_planet_symbol')->comment('関係の終点となる惑星のシンボル（惑星記号）');
            $table->text('content')->comment('アスペクトの説明・内容');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appraisal_result_other_infos');
    }
};
