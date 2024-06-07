<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bookbinding;

class BookbindingSolarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('bookbindings')->insert([
            'price' => Bookbinding::PRICE_SOLAR,
            'is_enabled' => Bookbinding::PRICE_FLAG_TRUE,
            'solar_return' => Bookbinding::SOLAR_FLAG_TRUE,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
