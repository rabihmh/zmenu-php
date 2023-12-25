<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => $this->faker->numberBetween(225, 324),
            'product_id' => $this->faker->numberBetween(1, 4),
            'price' => $this->faker->randomFloat(2, 5, 50),
            'quantity' => $this->faker->numberBetween(1, 5),
        ];
    }
}
