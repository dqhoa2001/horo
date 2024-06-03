<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplateSeeder9 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('templates')->insert([
            [
                'template_name' => 'リマインダー 太陽光発電購入メール',
                'class_name' => 'ReminderPurchaseSolar',
                'title' => '【星の舞】リマインダー 太陽光発電購入',
                'content' => '
                    {{$full_name}}様

                    あなたの誕生日は3か月後です。
                    太陽光発電を購入したいですか?
                ',
            ],
        ]);
    }
}
