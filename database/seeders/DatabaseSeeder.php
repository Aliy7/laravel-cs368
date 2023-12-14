<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder{
    use WithoutModelEvents;
    /**
     * Seed the application's database.
     */
    public function run(): void {

        $this->call(UserSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(LikeSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
       
    }
}
