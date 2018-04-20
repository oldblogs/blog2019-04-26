<?php

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
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);
    }
}

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Seed the application's database. Clear spatie permission cache. Create permissions, roles.
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
        $admin_role->givePermissionTo(Permission::all());
    }
}
