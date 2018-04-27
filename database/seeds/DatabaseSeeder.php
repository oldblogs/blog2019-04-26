<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 1)->create();
        factory(App\Post::class, 100)->create();
        factory(App\About::class, 1)->create();
        factory(App\Contact::class, 10)->create();
        
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);
    }
}

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Seed the application's database. Clear spatie permission cache. 
     * Create permissions, roles.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::findOrCreate('create post');
        Permission::findOrCreate('edit post');
        Permission::findOrCreate('delete post');
        Permission::findOrCreate('publish post');
        Permission::findOrCreate('unpublish post');
        
        // create roles and assign created permissions
        Role::findOrCreate('member');
        
        $admin_role = Role::findOrCreate('admin');
        $admin_role->revokePermissionTo(Permission::all());
        $admin_role->givePermissionTo(Permission::all());
    }
}
