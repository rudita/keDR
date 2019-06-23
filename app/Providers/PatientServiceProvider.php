<?php

namespace App\Providers;

use App\Models\PatientAccount;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Cache\PatientAccountCacheDecorator;
use App\Repositories\Eloquent\EloquentPatientAccountRepository;

class PatientServiceProvider extends ServiceProvider
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
        $this->app->bind('App\\Repositories\\PatientAccountRepository', function(){
            $repository = new EloquentPatientAccountRepository(new PatientAccount());

            if ( ! env('APP_CACHE', false) ) {
                return $repository;
            }
            return new PatientAccountCacheDecorator($repository);
        });
    }
}
