<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Post;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{

    //protected $model = Category::class;

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
             * Otherwise create a new user and use their ID
             */
        'user_id' => User::count() ? User::all()->random()->id : User::factory()->create()->id,

        /**
         * If there are posts in the database, select a random post's ID.
         * Otherwise create a new post and use its ID.
         */
        'post_id' => Post::count() ? Post::all()->random()->id : Post::factory()->create()->id,
            'content' =>fake()->paragraph(4),
        ];
    }
}
