<?php

namespace App\Providers;

use App\Models\AclUser;
use App\Repositories\Cache\AclUserCacheDecorator;
use App\Repositories\Eloquent\EloquentAclUserRepository;
use Cartalyst\Sentinel\Roles\EloquentRole;
use Illuminate\Support\ServiceProvider;

class AclServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
    }

    private function registerBindings()
    {
        $this->app->bind('App\\Repositories\\AclUserRepository', function(){
            $repository = new EloquentAclUserRepository(new AclUser());

            if ( ! env('APP_CACHE', false) ) {
                return $repository;
            }
            return new AclUserCacheDecorator($repository);
        });

    }
}
