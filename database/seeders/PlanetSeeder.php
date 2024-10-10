<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('h_planets')->insert([
            'name' => '太陽',
            'name_en' => 'Sun',
            'symbol' => 'A',
            'title' => 'この人生の目的',
            'year_range' => '26～35歳',
            'class_name' => 'taiyo',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_planets')->insert([
            'name' => '月',
            'name_en' => 'Moon',
            'symbol' => 'B',
            'title' => '幼児期から変わらない、素のあなた',
            'year_range' => '０～７歳',
            'class_name' => 'tsuki',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_planets')->insert([
            'name' => '水星',
            'name_en' => 'Mercury',
            'symbol' => 'C',
            'title' => 'あなたの知的な興味関心',
            'year_range' => '8～15歳',
            'class_name' => 'suisei',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_planets')->insert([
            'name' => '金星',
            'name_en' => 'Venus',
            'symbol' => 'D',
            'title' => 'あなたの喜びや楽しみ',
            'year_range' => '16～25歳',
            'class_name' => 'kinsei',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_planets')->insert([
            'name' => '火星',
            'name_en' => 'Mars',
            'symbol' => 'E',
            'title' => '社会でチャレンジしたいこと',
            'year_range' => '36～45歳',
            'class_name' => 'kasei',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_planets')->insert([
            'name' => '木星',
            'name_en' => 'Jupiter',
            'symbol' => 'F',
            'title' => '社会的に恵まれること',
            'year_range' => '46～55歳',
            'class_name' => 'mokusei',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_planets')->insert([
            'name' => '土星',
            'name_en' => 'Saturn',
            'symbol' => 'G',
            'title' => '人生の課題や最終目的',
            'year_range' => '56歳以降',
            'class_name' => 'dosei',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_planets')->insert([
            'name' => '天王星',
            'name_en' => 'Uranus',
            'symbol' => 'H',
            'class_name' => 'tennousei',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_planets')->insert([
            'name' => '海王星',
            'name_en' => 'Neptune',
            'symbol' => 'I',
            'class_name' => 'kaiousei',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_planets')->insert([
            'name' => '冥王星',
            'name_en' => 'Pluto',
            'symbol' => 'J',
            'class_name' => 'meiousei',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_planets')->insert([
            'name' => 'ドラゴンヘッド',
            'name_en' => 'Dragon Head',
            'symbol' => 'L',
            'title' => '魂の課題',
            'class_name' => 'dragonhead',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_planets')->insert([
            'name' => 'キロン',
            'name_en' => 'Kilo',
            'symbol' => 'U',
            'class_name' => 'kiron',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_planets')->insert([
            'name' => 'リリス',
            'name_en' => 'Lili',
            'symbol' => 'T',
            'class_name' => 'ririsu',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_planets')->insert([
            'name' => 'AC',
            'name_en' => 'AC',
            'symbol' => '',
            'class_name' => 'ac',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_planets')->insert([
            'name' => 'MC',
            'name_en' => 'MC',
            'symbol' => '',
            'class_name' => 'mc',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
