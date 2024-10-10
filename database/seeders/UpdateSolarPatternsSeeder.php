<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdateSolarPatternsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Zodiac
        for ($i = 1; $i < 13; $i++) {
            for ($j = 1; $j < 16; $j++) {
                DB::table('h_zodiac_patterns')
                    ->where('zodiac_id', $i)
                    ->where('planet_id', $j)
                    ->update([
                        'content_solar' => 'Solar content of the ' . $i . ' zodiac by planet ' . $j,
                        'content_solar_en' => 'Solar content of the ' . $i . ' zodiac by planet ' . $j,
                        'updated_at' => Carbon::now()
                    ]);
            }
        }
        //Aspect
        for ($i = 1; $i <= 13; $i++) {
            for ($j = 1; $j <= 13; $j++) {
                for ($k = 1; $k <= 7; $k++) {
                    DB::table('h_aspect_patterns')
                        ->where('aspect_id', $k)
                        ->where('from_planet_id', $i)
                        ->where('to_planet_id', $j)
                        ->update([
                            'content_solar' => 'Solar content from planet ' . $i . ' to planet ' . $j . ' with aspect ' . $k,
                            'content_solar_en' => 'Solar content from planet ' . $i . ' to planet ' . $j . ' with aspect ' . $k,
                            'updated_at' => Carbon::now()
                        ]);
                }
            }
        }
        //Sabian
        for ($i = 1; $i <= 12; $i++) {
            for ($j = 1; $j <= 30; $j++) {
                DB::table('h_sabian_patterns')
                    ->where('zodiac_id', $i)
                    ->where('sabian_degrees', $j)
                    ->update([
                        'title_solar' => 'Solar title of the ' . $j . '° of ' . $i . ' zodiac',
                        'title_solar_en' => 'Solar title of the ' . $j . '° of ' . $i . ' zodiac',
                        'content_solar' => 'Solar content of the ' . $j . '° of ' . $i . ' zodiac',
                        'content_solar_en' => 'Solar content of the ' . $j . '° of ' . $i . ' zodiac',
                        'updated_at' => Carbon::now()
                    ]);
            }
        }
        //House
        for ($i = 1; $i < 13; $i++) {
            for ($j = 1; $j < 14; $j++) {
                DB::table('h_house_patterns')
                    ->where('house_id', $i)
                    ->where('planet_id', $j)
                    ->update([
                        'content_solar' => 'Solar content of the ' . $i . ' house by planet ' . $j,
                        'content_solar_en' => 'Solar content of the ' . $i . ' house by planet ' . $j,
                        'updated_at' => Carbon::now()
                    ]);
            }
        }
    }
}
