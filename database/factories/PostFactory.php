<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => fake()->numberBetween(1, 9),
            'user_id' => fake()->randomDigitNotNull(),
            'title' => fake()->sentence(),
            'is_headline' => fake()->boolean(),
            'is_top_headline' => fake()->boolean(),
            'is_published' => fake()->boolean(),
            'pict' => 'img/dummy-img.jpg',
            'body' => fake()->realText(),
        ];
    }
}
