<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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
        $title = $this->faker->sentence;

        return [
            'user_id' => 2,
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->paragraph,
            'content' => $this->faker->text,
            'thumbnail' => $this->faker->imageUrl(),
            'publish_date' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'status' => $this->faker->randomElement(['0', '1', '2']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
