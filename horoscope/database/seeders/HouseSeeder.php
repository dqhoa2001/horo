<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('h_houses')->insert([
            'name' => '1ハウス',
            'name_en' => '1ハウス',
            'symbol' => '1',
            'class_name' => 'ac',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_houses')->insert([
            'name' => '2ハウス',
            'name_en' => 'House2nd',
            'symbol' => '2',
            'class_name' => '2',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_houses')->insert([
            'name' => '3ハウス',
            'name_en' => 'House3rd',
            'symbol' => '3',
            'class_name' => '3',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_houses')->insert([
            'name' => '4ハウス',
            'name_en' => 'House4th',
            'symbol' => '4',
            'class_name' => '4',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_houses')->insert([
            'name' => '5ハウス',
            'name_en' => 'House5th',
            'symbol' => '5',
            'class_name' => '5',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_houses')->insert([
            'name' => '6ハウス',
            'name_en' => 'House6th',
            'symbol' => '6',
            'class_name' => '6',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_houses')->insert([
            'name' => '7ハウス',
            'name_en' => 'House7th',
            'symbol' => '7',
            'class_name' => '7',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_houses')->insert([
            'name' => '8ハウス',
            'name_en' => 'House8th',
            'symbol' => '8',
            'class_name' => '8',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_houses')->insert([
            'name' => '9ハウス',
            'name_en' => 'House9th',
            'symbol' => '9',
            'class_name' => '9',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_houses')->insert([
            'name' => '10ハウス',
            'name_en' => '10ハウス',
            'symbol' => '10',
            'class_name' => 'mc',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_houses')->insert([
            'name' => '11ハウス',
            'name_en' => 'House11th',
            'symbol' => '11',
            'class_name' => '11',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_houses')->insert([
            'name' => '12ハウス',
            'name_en' => 'House12th',
            'symbol' => '12',
            'class_name' => '12',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
