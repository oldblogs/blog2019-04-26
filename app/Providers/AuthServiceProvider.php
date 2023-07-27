<?php

namespace App\Providers;

use App\Post;
use App\Policies\PostPolicy;

use App\Dashboard;
use App\Policies\DashboardPolicy;

use App\About;
use App\Policies\AboutPolicy;

use App\Sociallink;
use App\Policies\SociallinkPolicy;

use App\Csocial;
use App\Policies\CsocialPolicy;

use App\Email;
use App\Policies\EmailPolicy;

use App\Test;
use App\Policies\TestPolicy;

use App\Medium;
use App\Policies\MediumPolicy;

use App\MediumType;
use App\Policies\MediumTypePolicy;

use App\License;
use App\Policies\LicensePolicy;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
      // 'App\Model' => 'App\Policies\ModelPolicy',
      Post::class => PostPolicy::class,
      Dashboard::class => DashboardPolicy::class,
      About::class => AboutPolicy::class,
      Sociallink::class => SociallinkPolicy::class,
      Csocial::class => CsocialPolicy::class,
      Email::class => EmailPolicy::class,
      Test::class => TestPolicy::class,
      Medium::class => MediumPolicy::class,
      MediumType::class => MediumTypePolicy::class,
      // License::class => LicensePolicy::class,
    ];

    /**
     * Register authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
      $this->registerPolicies();

      // Passport::tokensCan([
      //   'place-orders' => 'Place orders',
      //   'check-status' => 'Check order status',
      // ]);

      Passport::routes();

      // Passport::tokensExpireIn(now()->addDays(15));

      // Passport::refreshTokensExpireIn(now()->addDays(30));
    }
}
