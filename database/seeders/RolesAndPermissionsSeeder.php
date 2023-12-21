<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()['cache']->forget('spatie.permission.cache');
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        //creating three roles admin,mod,user

        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $mod = Role::firstOrCreate(['name' => 'mod', 'guard_name' => 'web']);
        // $userRole = Role::create(['name' => 'user', 'guard_name' => 'web']);

        $editPosts = Permission::firstOrCreate(['name' => 'edit posts', 'guard_name' => 'web']);
        $deletePosts = Permission::firstOrCreate(['name' => 'delete posts', 'guard_name' => 'web']);
        $createPosts = Permission::firstOrCreate(['name' => 'create posts', 'guard_name' => 'web']);
        $deleteUsers = Permission::firstOrCreate(['name' => 'delete users', 'guard_name' => 'web']);
        $updateUsers = Permission::firstOrCreate(['name' => 'update users', 'guard_name' => 'web']);

        //level of permission
        $deleteAllPosts = Permission::firstOrCreate(['name' => 'delete all posts', 'guard_name' => 'web']);
        $deleteAllComments = Permission::firstOrCreate(['name' => 'delete all posts', 'guard_name' => 'web']);

        //creating admin user with higher privellege
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }

        if (!Role::where('name', 'mod')->exists()) {
            Role::create(['name' => 'mod']);
        }
        $adminUser = User::firstOrCreate(
            ['email' => 'hass@swansea.ac.uk'],
            [
                'username' => 'Hassan bin Ali',
                'first_name' => 'Hassan',
                'last_name' => 'Bin Ali',
                'password' => Hash::make('Swansea123@')
            ]
        );
        $adminUser->assignRole('admin');

        // Create moderator user with some privillege
        $modUser = User::firstOrCreate(
            ['email' => 'hussein@swansea.ac.uk'], 
            [
                'username' => 'Hussein bin ali',
                'first_name' => 'Hussein',
                'last_name' => 'Bin Ali',
                'password' => Hash::make('Swansea123@') 
            ]
        );
        $modUser->assignRole('mod'); 
    }
}
