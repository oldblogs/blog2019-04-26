<?php

namespace App\Providers;
use App\Post;
use App\Dashboard;
use App\About;
use App\Policies\PostPolicy;
use App\Policies\DashboardPolicy;
use App\Policies\AboutPolicy;
// use Laravel\Passport\Passport;
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
    ];

    /**
     * Register authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Passport::routes();

        // Passport::tokensExpireIn(now()->addDays(15));

        // Passport::refreshTokensExpireIn(now()->addDays(30));
    }
}
