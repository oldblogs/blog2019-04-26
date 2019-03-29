<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Socialprovider;
use App\Csocial;

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

        $this->call([
            SocialprovidersSeeder::class,
        ]);

        $this->call([
            CsocialSeeder::class,
        ]);

    }
}

class CsocialSeeder extends Seeder
{
    /**
     * Seed the application's csocials table.
     *
     * @return void
     */
    public function run()
    {

      $sCsocials = [
        [ 'title' => 'github', 'css_class' => 'fa-github', 'homepage' => 'https://github.com/'],
        [ 'title' => 'stackoverflow', 'css_class' => 'fa-stack-overflow', 'homepage' => 'https://stackoverflow.com/'],
        [ 'title' => 'twitter', 'css_class' => 'fa-twitter', 'homepage' => 'https://twitter.com/'],
        [ 'title' => 'google', 'css_class' => 'fa-fa-google', 'homepage' => 'https://www.google.com/'],

      ];

      foreach ( $sCsocials as $sCsocial ){
        $xCsocial = Csocial::firstOrCreate($sCsocial );
      }

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
      // but these should be configured in config files before use
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

        // Permissions
        // For now no permissions defined, all management panel actions require admin role
        // Individual permissions will be implemented in future versions.

        // Create roles

        // Member role does not have any permission , and is the default role
        $member_role = Role::findOrCreate('member');
        $member_role->revokePermissionTo(Permission::all());

        // Admin role must have all the permissions
        $admin_role = Role::findOrCreate( 'admin', 'web' );
        $admin_role->revokePermissionTo(Permission::all());
        $admin_role->givePermissionTo( Permission::where('guard_name','web')->get() );

        // Another admin role for api guard
        $api_admin_role = Role::findOrCreate( 'apiadmin', 'api' );
        $api_admin_role->revokePermissionTo(Permission::all());
        $api_admin_role->givePermissionTo( Permission::where('guard_name','api')->get() );

    }
}
