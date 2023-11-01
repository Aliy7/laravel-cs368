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
       // $user = User::factory()->create();
        return [
            // 'user_id' => User::factory(),
            'user_id' => User::count() ? User::all()->random()->id : User::factory()->create()->id,
            'post_content' => $this->faker->paragraph(6),
            'image_url' => $this->faker->imageUrl(),
            'post_date' => $this->faker->date,
            'post_time' => $this->faker->time

            //
        ];
    }
}
