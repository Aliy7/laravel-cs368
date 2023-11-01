<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       
        $categoryNames = ['Technology', 'Health', 'Education', 'Travel', 'Food', 'Fashion', 'Music', 'Movies', 'Sports', 'Lifestyle'];
        return [
            //
            'cat_name' => $this->faker->randomElement($categoryNames),
            'post_id' => Post::count() ? Post::all()->random()->id : Post::factory()->create()->id,

        ];
    }
}
