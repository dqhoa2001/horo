<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Appraisal;

class AppraisalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('appraisals')->insert([
            'price' => Appraisal::PRICE,
            'family_price' => 7700,
            'is_enabled' => Appraisal::PRICE_FLAG_TRUE,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
