<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AspectAngleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $type1 = [
        //     1 => [0, 22.5, 45, 67.5, 90, 112.5, 135, 157.5, 180, 360],
        //     2 => [15, 30, 60, 75, 105, 120, 150, 165],
        //     3 => [9, 18, 24, 36, 48, 54, 72, 96, 108, 126, 144, 162, 168],
        //     4 => [25.71, 51.43, 77.14, 102.86, 128.57, 154.29],
        //     5 => [10, 20, 40, 80, 160],
        //     6 => [32.83, 65.45, 98.18, 130.91, 163.63],
        // ];
        $type1 = [
            1 => [0],
            2 => [180],
            3 => [90],
            4 => [120],
            5 => [60],
            6 => [30],
            7 => [150]
        ];
        $bindings = [];
        foreach ($type1 as $type => $angles) {
            foreach ($angles as $angle) {
                $bindings[] = [
                    'type' => $type,
                    'angle' => $angle,
                    'symbol' => '',
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }
        DB::table('m_aspect_angles')->insert($bindings);
    }
}