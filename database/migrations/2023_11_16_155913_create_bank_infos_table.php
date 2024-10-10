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
        Schema::create('bank_infos', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name')->comment('銀行名');
            $table->string('branch_name')->comment('支店名');
            $table->string('branch_code')->comment('支店コード');
            $table->string('account_type')->comment('口座種別');
            $table->string('account_number')->comment('口座番号');
            $table->string('account_holder')->comment('口座名義人');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_infos');
    }
};
