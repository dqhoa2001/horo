<?php

namespace Database\Seeders;

use App\Models\Appraisal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppraisalSolarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('appraisals')->insert([
            'price' => Appraisal::PRICE_SOLAR,
            'family_price' => 7480,
            'is_enabled' => Appraisal::PRICE_FLAG_TRUE,
            'solar_return' => Appraisal::SOLAR_FLAG_TRUE,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
