<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = ['edit post', 'delete post', 'create post', 'view post'];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
