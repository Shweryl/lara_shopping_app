<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(5, true),
            'category_id' => rand(1,6),
            'user_id' => 1,
            'price' => rand(10, 2000),
            'stock' => rand(10, 1000),
            'description' => fake()->text(),
        ];
    }
}
