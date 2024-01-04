<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Temperature>
 */
class TemperatureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sale_date' => $this->faker->dateTimeBetween('-3 month', 'now'),
            'temperature' => $this->faker->numberBetween(0, 15),
            'weather' => $this->faker->numberBetween(1, 8),
        ];
    }
}
