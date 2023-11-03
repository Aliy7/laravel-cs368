<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Post;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      
        return [
            'user_id' => User::count() ? User::all()->random()->id : User::factory()->create()->id,
            'post_id' => Post::count() ? Post::all()->random()->id : Post::factory()->create()->id,
            'comment_content' => $this->faker->paragraph(4),
            'feed_back' => $this->faker->sentence,
            'date' => $this->faker->date,
            'time' => $this->faker->time,

            //
        ];
    }
}
