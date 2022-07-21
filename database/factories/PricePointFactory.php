<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PricePoint>
 */
class PricePointFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'symbol' => 'BTCUSD',
            'last_price' => fake()->numberBetween(1000, 2000),
            'low' => fake()->numberBetween(1000, 2000),
            'high' => fake()->numberBetween(1000, 2000),
            'ask' => fake()->numberBetween(1000, 2000),
            'volume' => fake()->numberBetween(1000, 2000),
        ];
    }
}
