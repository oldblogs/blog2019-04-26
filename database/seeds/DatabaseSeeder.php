<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Socialprovider;

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

        $this->call([
            SocialprovidersSeeder::class,
        ]);
    }
}

class SocialprovidersSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $pGoogle = new Socialprovider();
      $pGoogle->provider = "google";
      $pGoogle->iss_str1 = "accounts.google.com";
      $pGoogle->iss_str2 = "https://accounts.google.com";
      $pGoogle->save();
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
        Permission::findOrCreate('view dashboard');
        Permission::findOrCreate('browse post');
        Permission::findOrCreate('view post');
        Permission::findOrCreate('create post');
        Permission::findOrCreate('update post');
        Permission::findOrCreate('delete post');
        Permission::findOrCreate('publish post');
        Permission::findOrCreate('unpublish post');
        Permission::findOrCreate('view dashboard');
        Permission::findOrCreate('view component');
        Permission::findOrCreate('create component');
        Permission::findOrCreate('update component');
        Permission::findOrCreate('delete component');

        // create roles and assign created permissions

        // member role does not have any permission
        Role::findOrCreate('member');

        // admin role has all the permissions
        $admin_role = Role::findOrCreate('admin');
        $admin_role->revokePermissionTo(Permission::all());
        $admin_role->givePermissionTo(Permission::all());


    }
}
