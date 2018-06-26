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
        // Required records
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);

        $this->call([
            SocialprovidersSeeder::class,
        ]);
        
        // Sample Records
        factory(App\User::class, 1)->create();
        factory(App\Post::class, 100)->create();
        factory(App\About::class, 5)->create();
        
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
        
        // Contacts
        Permission::findOrCreate('browse contact');

        // Emails
        Permission::findOrCreate('browse email');
        Permission::findOrCreate('create email');
        Permission::findOrCreate('store email');
        Permission::findOrCreate('show email');
        Permission::findOrCreate('edit email');
        Permission::findOrCreate('update email');
        Permission::findOrCreate('delete email');
        
        Permission::findOrCreate('browse email', 'api');
        Permission::findOrCreate('create email', 'api');
        Permission::findOrCreate('store email', 'api');
        Permission::findOrCreate('show email', 'api');
        Permission::findOrCreate('edit email', 'api');
        Permission::findOrCreate('update email', 'api');
        Permission::findOrCreate('delete email', 'api');
        
        // Csocials
        Permission::findOrCreate('browse csocial');
        Permission::findOrCreate('create csocial');
        Permission::findOrCreate('store csocial');
        Permission::findOrCreate('show csocial');
        Permission::findOrCreate('edit csocial');
        Permission::findOrCreate('update csocial');
        Permission::findOrCreate('delete csocial');
        
        // Create roles and assign created permissions

        // Member role does not have any permission
        Role::findOrCreate('member');

        $admin_role = Role::findOrCreate( 'admin', 'web' );
        $admin_role->revokePermissionTo(Permission::all());
        // $admin_role->givePermissionTo(Permission::all);
        $admin_role->givePermissionTo([ 
            'view dashboard',
            'view component',
            'create component',
            'store component',
            'edit component',
            'update component',
            'delete component',
            'browse post',
            'create post',
            'store post',
            'view post',
            'edit post',
            'update post',
            'delete post',
            'publish post',
            'unpublish post',
            'browse about',
            'create about',
            'store about',
            'show about',
            'edit about',
            'update about',
            'delete about',
            'browse contact',
            'browse email',
            'create email',
            'store email',
            'show email',
            'edit email',
            'update email',
            'delete email',
            'browse csocial',
            'create csocial',
            'store csocial',
            'show csocial',
            'edit csocial',
            'update csocial',
            'delete csocial',
          ]);
        
        // admin role has all the permissions
        $api_admin_role = Role::findOrCreate( 'apiadmin', 'api' );
        $api_admin_role->revokePermissionTo(Permission::all());
        // $api_admin_role->givePermissionTo(Permission::all);
        $api_admin_role->givePermissionTo( [ 
            'browse email',
            'create email',
            'store email',
            'show email',
            'edit email',
            'update email',
            'delete email',
          ]);
        
    }
}
