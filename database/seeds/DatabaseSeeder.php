<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Socialprovider;
use App\Csocial;
use App\MediumType;
use App\License;
use App\Medium;

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

class CsocialSeeder extends Seeder {
  /**
   * Seed the application's csocials table.
   *
   * @return void
   */
  public function run(){

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

class MediumTypeSeeder extends Seeder {
  /**
   * Seed the application's medium_types table.
   * 
   * @return void
   */
  public function run() {
    $sMediumTypes = [
      [ 'mtype' => 'image', 'msubtype' => 'gif', 'mclass' => 'discrete'],
      [ 'mtype' => 'image', 'msubtype' => 'jpeg', 'mclass' => 'discrete'],
      [ 'mtype' => 'image', 'msubtype' => 'png', 'mclass' => 'discrete'],
      [ 'mtype' => 'image', 'msubtype' => 'webp', 'mclass' => 'discrete'],
      [ 'mtype' => 'image', 'msubtype' => 'svg+xml', 'mclass' => 'discrete'],
      [ 'mtype' => 'image', 'msubtype' => 'x-icon', 'mclass' => 'discrete'],
    ];

    foreach ( $sMediumTypes as $sMediumType ){
      $xMediumType = MediumType::firstOrCreate($sMediumType);
    }
  }
}

class LicenseSeeder extends Seeder {
  /**
   * Seed the application's license table.
   * 
   * @return void
   */
  public function run() {
    $sLicences = [
      [ 
        'spdx' => 'CC-BY-4.0', 
        'lic_name' => 'Creative Commons Attribution 4.0 International', 
        'lic_deed' => 'https://spdx.org/licenses/CC-BY-4.0.html#licenseText', 
        'legal' => '', 
        'fsf' => true, 
        'osi' => false,
      ],
      [ 
        'spdx' => 'CC-BY-NC-4.0',
        'lic_name' => 'Creative Commons Attribution Non Commercial 4.0 International',
        'lic_deed' => 'https://spdx.org/licenses/CC-BY-NC-4.0.html#licenseText',
        'legal' => '',
        'fsf' => false,
        'osi' => false,
      ],
      [ 
        'spdx' => 'CC-BY-NC-ND-4.0',
        'lic_name' => 'Creative Commons Attribution Non Commercial No Derivatives 4.0 International',
        'lic_deed' => 'https://spdx.org/licenses/CC-BY-NC-ND-4.0.html#licenseText',
        'legal' => '',
        'fsf' => false,
        'osi' => false,
      ],
      [ 
        'spdx' => 'CC-BY-NC-SA-4.0',
        'lic_name' => 'Creative Commons Attribution Non Commercial Share Alike 4.0 International',
        'lic_deed' => 'https://spdx.org/licenses/CC-BY-NC-SA-4.0.html#licenseText',
        'legal' => '',
        'fsf' => false,
        'osi' => false,
      ],
      [ 
        'spdx' => 'CC-BY-ND-4.0',
        'lic_name' => 'Creative Commons Attribution No Derivatives 4.0 International',
        'lic_deed' => 'https://spdx.org/licenses/CC-BY-ND-4.0.html#licenseText',
        'legal' => '',
        'fsf' => false,
        'osi' => false,
      ],
      [ 
        'spdx' => 'CC-BY-SA-4.0',
        'lic_name' => 'Creative Commons Attribution Share Alike 4.0 International',
        'lic_deed' => 'https://spdx.org/licenses/CC-BY-SA-4.0.html#licenseText',
        'legal' => '',
        'fsf' => true,
        'osi' => false,
      ],
    ];

    foreach ($sLicences as $sLicence){
      $xLicense = License::firstOrCreate($sLicence);
    }
  }
}

class MediumSeeder extends Seeder {
  /**
   * Seed the application's media table. 
   * 
   * @return void
   */
  public function run() {

    $sMedia = [
      [
        'enabled' => true,
        'description' => 'Creative Commons BY logo',
        'medium_type_id' => 3,
        'license_id' => 1,
        'file' => 'by.png',
        'external_url' => null,
        'stock_url' => 'https://creativecommons.org/about/downloads',
        'stock_desc' => 'CC Buttons BY',
      ],  
      [
        'enabled' => true,
        'description' => 'Creative Commons BY logo',
        'medium_type_id' => 5,
        'license_id' => 1,
        'file' => 'by.svg',
        'external_url' => null,
        'stock_url' => 'https://creativecommons.org/about/downloads',
        'stock_desc' => 'CC Buttons BY',
      ], 
    ];

    foreach ($sMedia as $sMedium) {
      $xMedium = Medium::firstOrCreate($sMedium);
    }

  }
}

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
        SocialprovidersSeeder::class,
        CsocialSeeder::class,
        MediumTypeSeeder::class,
        LicenseSeeder::class,
        MediumSeeder::class,
      ]);
    }
}






