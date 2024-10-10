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
        Schema::create('bookbindings', function (Blueprint $table) {
            $table->id();
            $table->integer('price')->comment('製本の金額');
            $table->boolean('is_enabled')->comment('適応フラグ 0:無効 1:有効');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookbindings');
    }
};
