<?php

namespace Database\Seeders;
use App\Models\Like;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   
    public function run(): void
    
    {
        $likes_size = 50;
        Like::factory()->count($likes_size)->create();
    }
}
