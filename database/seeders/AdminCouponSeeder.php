<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminCouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('admin_coupons')->insert([
            [
                'user_id'        => 1,
                'coupon_name'    => 'LINE公式限定',
                'coupon_code'    => 'stellar2023',
                'coupon_price'   => 2800,
                'back_point'     => 0,
                'time_limit'     => 0,
                'time_limit_day' => '2023-12-31',
                'use_limit'      => 99,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'user_id'        => 1,
                'coupon_name'    => '減額用',
                'coupon_code'    => 'stellar8800',
                'coupon_price'   => 8800,
                'back_point'     => 0,
                'time_limit'     => 0,
                'time_limit_day' => '2099-12-31',
                'use_limit'      => 99,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]
        );
    }
}
