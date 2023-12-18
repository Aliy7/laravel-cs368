<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();
        $tags = Tag::all();

        // Iterate over each post
        foreach ($posts as $post) {
            // Select a random number of tag IDs
            $tagIds = $tags->random(rand(1, 3))->pluck('id');

            // Attach the selected tag IDs to the current post
            $post->tags()->sync($tagIds);
        }
    }
    }

