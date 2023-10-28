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
                'user_id' => User::all()->random()->id ?? User::factory(),

                'post_id' => Post::all()->random()->id ?? Post::factory(),

            //
        ];
    }
}
