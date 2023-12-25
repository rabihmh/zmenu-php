<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $year = date('Y'); // Get the current year
        $month = $this->faker->numberBetween(1, 12);
        return [
            'table_id' => $this->faker->numberBetween(1, 3), // Replace with your table IDs
            'number' => 'ORD' . $this->faker->unique()->numberBetween(100, 999),
            'status' => $this->faker->randomElement(['pending', 'completed', 'canceled']),
            'total' => $this->faker->randomFloat(2, 10, 100),
            'created_at' => $this->faker->dateTimeBetween("{$year}-{$month}-01", "{$year}-{$month}-31"), // Random timestamp within the same year and different months

        ];
    }
}
