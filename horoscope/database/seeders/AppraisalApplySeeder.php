<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppraisalApplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('appraisal_applies')->insert([
            [
                'reference_type'        => 'App\Models\User',
                'reference_id'          => 1,
                'birthday'              => '2000-01-23',
                'birthday_time'         => '12:34',
                'birthday_prefectures'  => '東京都',
                'birthday_city'         => '渋谷区',
                'longitude'             => '139.700306',
                'latitude'              => '35.658065',
                'timezome'              => 9,
            ],
            [
                'reference_type'        => 'App\Models\Family',
                'reference_id'          => 1,
                'birthday'              => '1999-12-23',
                'birthday_time'         => '12:00',
                'birthday_prefectures'  => '神奈川県',
                'birthday_city'         => '横浜市',
                'longitude'             => '139.700306',
                'latitude'              => '35.658065',
                'timezome'              => 9,
            ],
            [
                'reference_type'        => 'App\Models\User',
                'reference_id'          => 1,
                'birthday'              => '1995-01-01',
                'birthday_time'         => '08:00',
                'birthday_prefectures'  => '大阪府',
                'birthday_city'         => '大阪市阿倍野区',
                'longitude'             => '139.700306',
                'latitude'              => '35.658065',
                'timezome'              => 9,
            ],
            [
                'reference_type'        => 'App\Models\User',
                'reference_id'          => 1,
                'birthday'              => '2020-02-02',
                'birthday_time'         => '10:00',
                'birthday_prefectures'  => '福岡県',
                'birthday_city'         => '福岡市博多区',
                'longitude'             => '139.700306',
                'latitude'              => '35.658065',
                'timezome'              => 9,
            ],
        ]);
    }
}
