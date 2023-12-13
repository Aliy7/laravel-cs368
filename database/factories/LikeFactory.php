<?php

namespace Database\Factories;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
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
        
        $likableTypes = [Post::class, Comment::class];
        $likableType = fake()->randomElement($likableTypes);
        $likable = $likableType::inRandomOrder()->first() ?? $likableType::factory()->create();

        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'likable_id' => $likable->id,
            'likable_type' => get_class($likable),
            'value' => fake()->randomElement([1, -1]), // 1 for like, -1 for dislike
        ];
    }
}