<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdminCoupon>
 */
class AdminCouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 2),
            'coupon_name' => $this->faker->unique()->regexify('クーポン[0-9]{3}'),
            'coupon_code' => $this->faker->unique()->bothify('???###'),
            'coupon_price' => $this->faker->numberBetween(50, 500),
            'back_point' => $this->faker->numberBetween(10, 100),
            'time_limit' => $this->faker->numberBetween(30, 180),
            'time_limit_day' => $this->faker->dateTimeBetween('now', '+1 years'),
            'use_limit' => $this->faker->numberBetween(1, 5),
        ];
    }
}
