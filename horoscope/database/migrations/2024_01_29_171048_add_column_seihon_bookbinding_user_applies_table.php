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
        Schema::table('bookbinding_user_applies', function (Blueprint $table) {
            $table->string('bookbinding_name')->nullable()->comment('製本に表示する名前')->after('appraisal_apply_id');
            $table->integer('is_design')->nullable()->comment('表紙の種類')->after('tel');
            $table->integer('order_id')->nullable()->comment('注文ID')->after('is_design');
            $table->integer('purchase_amount')->nullable()->comment('購入金額')->after('order_id');
            $table->date('scheduled_shipping_date')->nullable()->comment('発送予定日')->after('purchase_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookbinding_user_applies', function (Blueprint $table) {
            $table->dropColumn('bookbinding_name');
            $table->dropColumn('is_design');
            $table->dropColumn('order_id');
            $table->dropColumn('purchase_amount');
            $table->dropColumn('scheduled_shipping_date');
        });
    }
};
