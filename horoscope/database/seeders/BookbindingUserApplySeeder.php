<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookbindingUserApplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('bookbinding_user_applies')->insert([
            [
                'appraisal_apply_id' => 3,
                'is_delivery' => false,
                'name' => 'テスト名前',
                'post_number' => '1234567',
                'address' => '東京都渋谷区',
                'tel' => '09012345678',
            ],
            [
                'appraisal_apply_id' => 4,
                'is_delivery' => true,
                'name' => 'テスト2名前',
                'post_number' => '1234567',
                'address' => '東京都渋谷区',
                'tel' => '09012345678',
            ],
        ]);
    }
}
