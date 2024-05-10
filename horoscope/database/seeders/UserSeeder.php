<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert(
            [
                [
                    'name1'                => '設定用',
                    'name2'                => 'ユーザー',
                    'kana1'                => 'セッテイヨウ',
                    'kana2'                => 'ユーザー',
                    'email'                => 'user1@test.com',
                    'birthday'             => '2000-01-01',
                    'birthday_time'        => '12:00:00',
                    'password'             => \Hash::make('123123123Mm'),
                    'remember_token'       => \Str::random(10),
                    'email_verified_at'    => now(),
                    'birthday_prefectures' => '東京都',
                    'birthday_city'        => '墨田区',
                    'longitude'            => '133.935',
                    'latitude'             => '34.666',
                    'timezome'             =>  9,
                    'welcome_code'         => 'code0000',
                    'point_sum'            => 1000,
                    'created_at'           => now(),
                    'updated_at'           => now()
                ],
                [
                    'name1'                => '開発用',
                    'name2'                => 'ユーザー',
                    'kana1'                => 'カイハツヨウ',
                    'kana2'                => 'ユーザー',
                    'email'                => 'dev@minna-systems.co.jp',
                    'birthday'             => '1988-01-01',
                    'birthday_time'        => '12:00:00',
                    'password'             => \Hash::make('123123123Mm'),
                    'remember_token'       => \Str::random(10),
                    'email_verified_at'    => now(),
                    'birthday_prefectures' => '静岡県',
                    'birthday_city'        => '静岡市',
                    'longitude'            => '133.935',
                    'latitude'             => '34.666',
                    'timezome'             =>  9,
                    'welcome_code'         => 'code1234',
                    'point_sum'            => 1000,
                    'created_at'           => now(),
                    'updated_at'           => now()
                ],
            ]
        );
    }
}
