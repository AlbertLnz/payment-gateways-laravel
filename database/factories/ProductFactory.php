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
            'title' => $this->faker->sentence,
            'image' => $this->faker->imageUrl(640, 480), // (width, height)
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomElement([9.99, 19.99, 29.99, 39.99, 49.99])
        ];
    }
}
