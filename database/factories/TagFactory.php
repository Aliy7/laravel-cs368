<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $tagNames = [
            'Lifestyle', 'Sports', 'DreamBig', 'Politics', 'Health', 
            'Technology', 'Travel', 'Education', 'Food', 'Fashion', 
            'Music', 'Art', 'Science', 'Environment', 'Finance', 
            'Wellness', 'History', 'Photography', 'Movies', 'Books', 
            'Business', 'Gaming', 'DIY', 'Fitness', 'Culture', 'Lifestyle',
             'SkyDiving', 'Fortnight', 'Saufen',
            'Rennen','Schuldfrei','TierenWacht', 'Octoberfest','Volkfest'
        ];
        return [
                'name' => fake()->randomElement($tagNames)

            ];
         


    }
}
