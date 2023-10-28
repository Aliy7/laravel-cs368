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
        // $user = User::factory()->create();
        // $post = Post::factory() -> create();
        return [
            // 'user_id' => User::factory(),
            'user_id' => User::all()->random()->id ?? User::factory(),

            'post_id' => Post::all()->random()->id ?? Post::factory(),
            'comment_content' => $this->faker->paragraph(4),
            'feed_back' => $this->faker->sentence,
            'date' => $this->faker->date,
            'time' => $this->faker->time,

            //
        ];
    }
}
