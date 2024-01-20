<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'item_id' => $this->faker->numberBetween(1, 5),
            'sale_price' => $this->faker->randomElement([1000, 900, 800, 2000, 2200]),
            'quantity' => $this->faker->numberBetween(1, 30),
            'sale_cost' => $this->faker->randomElement([320, 400, 480, 580]),
            'temperature_id' => $this->faker->numberBetween(1, 60),
        ];
    }
}
