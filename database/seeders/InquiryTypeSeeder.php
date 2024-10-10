<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InquiryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('inquiry_types')->insert(
            [
                [
                    'name' => '鑑定について'
                ],
                [
                    'name' => '製本について'
                ],
                [
                    'name' => 'メールアドレスを忘れた'
                ],
                [
                    'name' => 'サービスに関するお問い合せ'
                ],
                [
                    'name' => '取材など広報に関するお問い合せ'
                ],
                [
                    'name' => 'その他'
                ],
            ]
        );
    }
}
