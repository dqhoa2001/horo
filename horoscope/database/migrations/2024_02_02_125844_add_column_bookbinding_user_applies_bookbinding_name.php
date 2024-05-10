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
            $table->string('bookbinding_name1')->nullable()->comment('製本に表示する性')->after('appraisal_apply_id');
            $table->string('bookbinding_name2')->nullable()->comment('製本に表示する名')->after('bookbinding_name1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookbinding_user_applies', function (Blueprint $table) {
            $table->dropColumn('bookbinding_name1');
            $table->dropColumn('bookbinding_name2');
        });
    }
};
