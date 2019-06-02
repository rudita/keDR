<?php

namespace App\Providers;

use App\Models\DoctorAccount;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Cache\DoctorAccountCacheDecorator;
use App\Repositories\Eloquent\EloquentDoctorAccountRepository;

class DoctorServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
    }

    protected function registerBindings()
    {
        $this->app->bind('App\\Repositories\\DoctorAccountRepository', function(){
            $repository = new EloquentDoctorAccountRepository(new DoctorAccount());

            if ( ! env('APP_CACHE', false) ) {
                return $repository;
            }
            return new DoctorAccountCacheDecorator($repository);
        });
    }
}
