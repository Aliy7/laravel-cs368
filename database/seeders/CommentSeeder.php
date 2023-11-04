<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * create comment of size 20
     * 
     */
   
    public function run(): void{
        $comment_size = 20;
        Comment::factory()-> count($comment_size)->create();
    }
}
