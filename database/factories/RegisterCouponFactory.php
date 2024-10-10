<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RegisterCoupon>
 */
class RegisterCouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'coupon_price' => 100,
            'back_point' => 100,
            'time_limit' => 60,
            'use_limit' => 1,
        ];
    }
}
