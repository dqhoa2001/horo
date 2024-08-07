<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AspectPatternSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $bindings = [];
        for ($i = 1; $i <= 13; $i++) {
            for ($j = 1; $j <= 13; $j++) {
                for ($k = 1; $k <= 7; $k++) {
                    $bindings[] = [
                        'aspect_id' => $k,
                        'from_planet_id' => $i,
                        'to_planet_id' => $j,
                        'content' => 'Aspect content from planet ' . $i . ' to planet ' . $j . ' with aspect ' . $k,
                        'content_en' => 'Aspect content from planet ' . $i . ' to planet ' . $j . ' with aspect ' . $k,
                        'content_solar' => 'Solar content from planet ' . $i . ' to planet ' . $j . ' with aspect ' . $k,
                        'content_solar_en' => 'Solar content from planet ' . $i . ' to planet ' . $j . ' with aspect ' . $k,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
            }
        }
        DB::table('h_aspect_patterns')->insert($bindings);

    }
}
