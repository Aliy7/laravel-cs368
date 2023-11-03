<?php

namespace Database\Factories;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   // protected $model = User::class;
    public function definition(): array{
        return [
            'user_name' => $this->faker->name(),
            'email' => $this->faker->unique()->userName . '@swansea.ac.uk', 
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email_verified_at' => now(),
            'password' => Hash::make('password'), 
            'post_code' => $this -> faker->postcode,
            'country' => 'United Kingdom',
            'remember_token' => $this->faker->randomNumber(8),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
