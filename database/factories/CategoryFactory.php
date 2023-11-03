<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       
        $categoryList = ['Gaming', 'Health', 'Nighouts', 'Travel', 'JunkFood', 'Fashion', 
        'Drillz', 'Pop', 'Football', 'Lifestyle', 'SkyDiving', 'Fortnight', 'Saufen',
        'Rennen','SelbstSchuld','TierenWacht'];
        return [
            'cat_name' => $this->faker->randomElement($categoryList),
        ];
    }
}
