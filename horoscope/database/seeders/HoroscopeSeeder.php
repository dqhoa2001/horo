<?php

namespace Database\Seeders;

use App\Models\AspectPattern;
use App\Models\HousePattern;
use App\Models\SabianPattern;
use App\Models\ZodiacPattern;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HoroscopeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bindings = [];
        for ($i = 1; $i <= 13; $i++) {
            for ($j = 1; $j <= 13; $j++) {
                for ($k = 1; $k <= 7; $k++) {
                    $bindings= [
                        'content_solar' => 'Content solar from planet ' . $i . ' to planet ' . $j . ' with aspect ' . $k,
                        'content_solar_en' => 'Content solar EN from planet ' . $i . ' to planet ' . $j . ' with aspect ' . $k,
                    ];
                }
            }
        }
        DB::table('h_aspect_patterns')->update($bindings);
        DB::table('h_house_patterns')->update($bindings);
        DB::table('h_sabian_patterns')->update($bindings);
        DB::table('h_zodiac_patterns')->update($bindings);
    }
}
