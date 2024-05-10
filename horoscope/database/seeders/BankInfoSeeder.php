<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('bank_infos')->insert([
            [
                'bank_name' => 'ゆうちょ銀行',
                'branch_name' => '一一八（読み　イチイチハチ）支店',
                'branch_code' => '',
                'account_type' => '普通',
                'account_number' => '4197745（記号 11180　番号 41977451）',
                'account_holder' => '株式会社星の舞　ｶ)ﾎｼﾉﾏｲ',                
            ],
        ]);
    }
}
