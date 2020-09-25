<?php

namespace App\Providers;

use Auth;
use Laravel\Passport\Passport;

use Illuminate\Cache\Repository;
use Illuminate\Contracts\Auth\UserProvider;
use App\Auth\UserProviderDecorator;
use App\Providers\CacheUserProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
         
        $this->registerPolicies();

         Auth::provider('cached', function ($app, array $config) {
         $provider = new EloquentUserProvider($app['hash'], $config['model']);
         $cache = $app->make(Repository::class);
         return new UserProviderDecorator($provider, $cache);
         });

        Passport::routes();    
    }
}
