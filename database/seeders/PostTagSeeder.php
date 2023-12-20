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
        foreach ($posts as $post) {
            $tagIds = $tags->random(rand(1, 3))->pluck('id');
            $post->tags()->sync($tagIds);
        }
    }
}
