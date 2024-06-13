<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateSeeder10 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('templates')->insert([
            [
                'template_name' => '申し込み後のサンクスメール',
                'class_name' => 'ThanksForPersonalAppraisal',
                'title' => '【星の舞】会員登録が完了致しました',
                'content' => '
                    当社の製品をお買い上げいただきありがとうございます
                ',
            ],
        ]);
    }
}
