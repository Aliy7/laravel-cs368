<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
            'user_id' => User::count() ? User::all()->random()->id : User::factory()->create()->id,
            'post_content' => fake()->paragraph(6),
            'image_url' => fake()->imageUrl(),
            'post_date' => fake()->date,
            'post_time' => fake()->time

        ];
    }
}
