<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::all();
        return [
           'user_id' => fake()->unique()->numberBetween(1, $users->count()),
            'bio' => fake()->sentence,
            'phone_number' => fake()->phoneNumber,
            'date_of_birth' => fake()->date($format='Y-m-d', $max='now'),
            'image_url' => fake()->imageUrl(),

        
        ];   

    }

}
