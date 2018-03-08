<?php

namespace App\Providers;

use \App\Billing\Stripe;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.sidebar', function ($view) {
            $archives = \App\Post::archives();
            $view->with( compact('archives') );
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Stripe::class, function (){
            return new Stripe(config('services.stripe.secret'));
        });
    }
}
