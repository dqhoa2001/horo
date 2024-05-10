<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bookbinding;

class BookbindingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('bookbindings')->insert([
            'price' => Bookbinding::PRICE,
            'is_enabled' => Bookbinding::PRICE_FLAG_TRUE,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
