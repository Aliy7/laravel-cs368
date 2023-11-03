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
        return [
          // Assign a random existing user's ID or create a new user if none exist.
          'user_id' => User::all()->random()->id ?? User::factory(),            
           'bio' => $this->faker->sentence,
            'avatar' => $this->faker->imageUrl(320, 350, 'human'),
            'phone_number' => $this->faker->phoneNumber,
            'date_of_birth' => $this->faker->date,
            'website_url' => $this->faker->url,
            'location' => $this->faker->city,
    
            //
        ];
    }
}
