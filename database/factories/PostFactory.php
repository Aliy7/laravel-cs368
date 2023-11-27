<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory {

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            /**
            * If there are users in the database, select a random user's ID.
            * Otherwise create a new user and use existing user's ID
            */
            // 'user_id' => User::count() ? User::all()->random()->id : User::factory()->create()->id,
            // 'user_id' => User::inRandomOrder()->first()->id, // Random existing user ID
            // 'category_id' => Category::inRandomOrder()->first()->id, // Random existing category ID
            // 'title' =>fake()->sentence,
            // 'content' => fake()->paragraph(7),
            'user_id' => User::inRandomOrder()->first()->id, // Assuming users exist
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory()->create()->id,
            'title' => fake()->sentence,
            'content' => fake()->paragraph(7),
            'image_url'=>fake()->url,
            

        ];
    }
}
