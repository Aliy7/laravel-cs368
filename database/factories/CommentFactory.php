<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
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
        $likableTypes = [Post::class, Comment::class];
        $likableType = $this->faker->randomElement($likableTypes);
        $likable = $likableType::inRandomOrder()->first() ?? $likableType::factory()->create();

        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'post_id' => Post::inRandomOrder()->first()->id ?? Post::factory()->create()->id,
            'content' => fake()->paragraph(4),
        ];
}
}