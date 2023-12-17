<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
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

      

        $user = new User();
        $user->id = 21;
        $user->username = 'Admin';
        $user->first_name='Hassan';
        $user->last_name='Bin Ali';
        $user->email = 'hass@swansea.ac.uk';
        $user->password = bcrypt('Swansea123@'); 
        $user->save();

        

        $user = User::find(21); 
        $user->assignRole('admin');



        $admin->givePermissionTo($editPosts);
        $admin->givePermissionTo($deletePosts);
        $admin->givePermissionTo($editPosts);
        $admin->givePermissionTo($deleteUsers);
        $admin->givePermissionTo($updateUsers);
        $admin->givePermissionTo($deleteAllComments);
        $admin->givePermissionTo($deleteAllPosts);


        // Assign permissions to user using grantPermissionTo
        $mod->givePermissionTo($editPosts);
        $mod->givePermissionTo($deletePosts);
        $mod->givePermissionTo($createPosts);



        
    }
}
