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

 
    // /**
    //  * Define the model's default state.
    //  *
    //  * @return array<string, mixed>
    //  */
    // public function definition(): array
    // {
      
    //     return [
    //         /**
    //          * If there are users in the database, select a random user's ID.
    //          * Otherwise create a new user and use their ID
    //          */
    //     'user_id' => User::count() ? User::all()->random()->id : User::factory()->create()->id,

    //     /**
    //      * If there are posts in the database, select a random post's ID.
    //      * Otherwise create a new post and use its ID.
    //      */
    //     'post_id' => Post::count() ? Post::all()->random()->id : Post::factory()->create()->id,
    //         'content' =>fake()->paragraph(4),
    //     ];
    // }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Randomly choose whether this like is for a Post or a Comment
        $likableTypes = [Post::class, Comment::class];
        $likableType = $this->faker->randomElement($likableTypes);
        $likable = $likableType::inRandomOrder()->first() ?? $likableType::factory()->create();

        return [
            // 'user_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            // 'likable_id' => $likable->id,
            // 'likable_type' => $likableType,
            // 'value' => $this->faker->randomElement([1, -1]), // 1 for like, -1 for dislike
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'post_id' => Post::inRandomOrder()->first()->id ?? Post::factory()->create()->id,
            'content' => fake()->paragraph(4),
        ];
}
}