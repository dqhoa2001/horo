<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegisterCouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('register_coupons')->insert([
            'coupon_price' => 500,
            'back_point' => 500,
            'time_limit' => 99,
            'use_limit' => 1,
        ]);
    }
}
