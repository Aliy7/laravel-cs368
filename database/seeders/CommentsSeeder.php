<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * 
     */
   
    public function run(): void{
        $comment_size = 10;
        Comment::factory()-> count($comment_size)->create();
    }
}
