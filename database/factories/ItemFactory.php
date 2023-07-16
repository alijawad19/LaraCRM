<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cost = fake()->numberBetween(1000, 9999);
        $price = fake()->numberBetween($cost, 9999);
        
        return [
            'name' => fake()->word(),
            'description' => fake()->sentence(),
            'cost' => $cost,
            'price' => $price,
        ];
    }
}
