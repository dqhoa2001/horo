<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AspectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {  
        DB::table('m_aspects')->insert([
            'name' => 'コンジャンクション',
            'name_en' => 'Conjunction',
            'type' => 1,
            'angle' => 0,
            'symbol' => 'm',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('m_aspects')->insert([
            'name' => '反対',
            'name_en' => 'Opposition',
            'type' => 2,
            'angle' => 180,
            'symbol' => 'n',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('m_aspects')->insert([
            'name' => '四角',
            'name_en' => 'Square',
            'type' => 3,
            'angle' => 90,
            'symbol' => 'o',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('m_aspects')->insert([
            'name' => 'トライン',
            'name_en' => 'Trine',
            'type' => 4,
            'angle' => 120,
            'symbol' => 'p',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('m_aspects')->insert([
            'name' => 'セクスタイル',
            'name_en' => 'Sextile',
            'type' => 5,
            'angle' => 60,
            'symbol' => 'q',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('m_aspects')->insert([
            'name' => 'セミセクスタイル',
            'name_en' => 'Semisextile',
            'type' => 6,
            'angle' => 30,
            'symbol' => 'r',
            'created_at' => now(),
            'updated_at' => now()
        ]);      
        DB::table('m_aspects')->insert([
            'name' => 'クインカンクス',
            'name_en' => 'Quincunx',
            'type' => 7,
            'angle' => 150,
            'symbol' => 's',
            'created_at' => now(),
            'updated_at' => now()
        ]);
       
    }
}