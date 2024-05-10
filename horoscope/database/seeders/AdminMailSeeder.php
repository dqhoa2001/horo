<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminMailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('admin_mails')->insert([
            [
                'email'      => 'butterfly.111220@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email'      => 'tenteco.mai12@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email'      => 'info@hoshino-mai.org',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
