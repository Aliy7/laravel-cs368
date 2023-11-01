<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    public function run(): void {
        $post_size = 20;
        $posts = Post::factory()->count($post_size)->create();
        
        foreach ($posts as $post) {
            Category::factory()->create(['post_id' => $post->id]);
        }
        

        
    }    
}
