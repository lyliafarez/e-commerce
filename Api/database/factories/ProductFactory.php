<?php

namespace Database\Factories;

use App\Models\Category;
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
    public function definition()
    {
        return [
           'title' => $this->faker->name(),
            'description' => $this->faker->paragraph(),
            'ref' => $this->faker->numberBetween($min = 5000000, $max = 9000000),
            'price' => $this->faker->numberBetween($min = 4, $max = 1000),
            'image_path' => $this->faker->imageUrl(),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
