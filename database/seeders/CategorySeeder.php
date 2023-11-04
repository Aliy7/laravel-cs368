<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    public function run(): void {
   
     // Create twenty categories 
     $categories = Category::factory()->count(20)->create();

        // Assign a random category to each post
        Post::all()->each(function ($post) use ($categories) {
        $post->update(['category_id' => $categories->random()->id]);
     });
    }    
}
