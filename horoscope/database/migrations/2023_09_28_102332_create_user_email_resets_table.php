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
        Schema::create('user_email_resets', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('メールアドレスを更新したユーザーID');
            $table->string('new_email')->comment('ユーザーが新規に設定したメールアドレス');
            $table->string('token');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_email_resets');
    }
};
