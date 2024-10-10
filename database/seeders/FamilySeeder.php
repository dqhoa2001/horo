<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('families')->insert([
            [
                'user_id'              => 2,
                'relationship'         => '父',
                'name1'                => '山田',
                'name2'                => '太郎',
                'birthday'             => '1960-04-04',
                'birthday_time'        => '12:00:00',
                'birthday_prefectures' => '東京都',
                'birthday_city'        => '渋谷区',
                'longitude'            => 139.698,
                'latitude'             => 35.689,
                'timezome'             => 9,
            ],
            [
                'user_id'              => 1,
                'relationship'         => '母',
                'name1'                => '山田',
                'name2'                => '洋子',
                'birthday'             => '1964-10-12',
                'birthday_time'        => '12:00:00',
                'birthday_prefectures' => '千葉県',
                'birthday_city'        => '千葉市',
                'longitude'            => 140.123,
                'latitude'             => 35.604,
                'timezome'             => 9,

            ],
        ]);
    }
}
