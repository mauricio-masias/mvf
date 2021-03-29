<?php

namespace App\Providers;

use App\Github\GetUserLanguageFeed;
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
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GetUserLanguageFeed::class, function ($app) {
            return new GetUserLanguageFeed(env('GITHUB_TOKEN'));
        });
    }
}
