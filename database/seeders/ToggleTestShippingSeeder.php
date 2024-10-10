<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToggleTestShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('toggle_test_shippings')->insert([
            'is_test_mode' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
