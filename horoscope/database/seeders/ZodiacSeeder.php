<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ZodiacSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('h_zodiacs')->insert([
            'name' => '牡羊座',
            'name_en' => 'Aries',
            'symbol' => 'a',
            'class_name' => 'ohitsuji',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_zodiacs')->insert([
            'name' => '牡牛座',
            'name_en' => 'Taurus',
            'symbol' => 'b',
            'class_name' => 'oushi',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_zodiacs')->insert([
            'name' => '双子座',
            'name_en' => 'Gemini',
            'symbol' => 'c',
            'class_name' => 'hutago',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_zodiacs')->insert([
            'name' => '蟹座',
            'name_en' => 'Cancer',
            'symbol' => 'd',
            'class_name' => 'kani',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_zodiacs')->insert([
            'name' => '獅子座',
            'name_en' => 'Leo',
            'symbol' => 'e',
            'class_name' => 'shishi',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_zodiacs')->insert([
            'name' => '乙女座',
            'name_en' => 'Virgo',
            'symbol' => 'f',
            'class_name' => 'otome',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_zodiacs')->insert([
            'name' => '天秤座',
            'name_en' => 'Libra',
            'symbol' => 'g',
            'class_name' => 'tenbin',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_zodiacs')->insert([
            'name' => '蠍  座',
            'name_en' => 'Scorpio',
            'symbol' => 'h',
            'class_name' => 'sasori',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_zodiacs')->insert([
            'name' => '射手座',
            'name_en' => 'Sagittarius',
            'symbol' => 'i',
            'class_name' => 'ite',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_zodiacs')->insert([
            'name' => '山羊座',
            'name_en' => 'Capricorn',
            'symbol' => 'j',
            'class_name' => 'yagi',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_zodiacs')->insert([
            'name' => '水瓶座',
            'name_en' => 'Aquarius',
            'symbol' => 'k',
            'class_name' => 'mizugame',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_zodiacs')->insert([
            'name' => '魚座',
            'name_en' => 'Pisces',
            'symbol' => 'l',
            'class_name' => 'uo',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
