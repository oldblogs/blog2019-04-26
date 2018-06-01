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
        factory(App\Post::class, 100)->create();
        factory(App\About::class, 5)->create();
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
      // Supported providers by Laravel Socialite
      // but these might not be configured in config files
      // TODO: fill in absent review links
      
      $sProviders = [ 
        [ 'provider' => 'github', 'review' => 'https://github.com/settings/connections/applications' ],
        [ 'provider' => 'bitbucket', 'review' => '' ],
        [ 'provider' => 'google', 'review' => 'https://myaccount.google.com/permissions' ],
        [ 'provider' => 'twitter', 'review' => '' ],
        [ 'provider' => 'linkedin', 'review' => '' ],
        [ 'provider' => 'facebook', 'review' => '' ],
      ];

      foreach ( $sProviders as $sProvider ){
        $xProvider = Socialprovider::firstOrCreate($sProvider );
      }
      
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
        Permission::findOrCreate('view component');
        Permission::findOrCreate('create component');
        Permission::findOrCreate('store component');
        Permission::findOrCreate('edit component');
        Permission::findOrCreate('update component');
        Permission::findOrCreate('delete component');
        
        // Posts
        // TODO: Update Post permissions for routes, controllers 
        Permission::findOrCreate('browse post');
        Permission::findOrCreate('create post');
        Permission::findOrCreate('store post');
        Permission::findOrCreate('view post');
        Permission::findOrCreate('edit post');
        Permission::findOrCreate('update post');
        Permission::findOrCreate('delete post');
        Permission::findOrCreate('publish post');
        Permission::findOrCreate('unpublish post');
        
        // Abouts
        Permission::findOrCreate('browse about');
        Permission::findOrCreate('create about');
        Permission::findOrCreate('store about');
        Permission::findOrCreate('show about');
        Permission::findOrCreate('edit about');
        Permission::findOrCreate('update about');
        Permission::findOrCreate('delete about');
        
        // Create roles and assign created permissions

        // Member role does not have any permission
        Role::findOrCreate('member');

        // admin role has all the permissions
        $admin_role = Role::findOrCreate('admin');
        $admin_role->revokePermissionTo(Permission::all());
        $admin_role->givePermissionTo(Permission::all());

    }
}
