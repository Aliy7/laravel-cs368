<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Post;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
            return [
           
                /**This line gets a random user ID from the database. 
                 * If there are no users, it creates a new user 
                 * and gets its ID. */
                'user_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
                'post_id' => Post::inRandomOrder()->first()->id ?? Post::factory()->create()->id,

                /**Generates either 1 or -1  - One for like and -1 for unlike */
                'value' => $this->faker->randomElement([1, -1]), 
            
        ];
    }
}
