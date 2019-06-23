<?php

namespace App\Providers;

use App\Models\DoctorSpecialist;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Cache\DoctorSpecialistCacheDecorator;
use App\Repositories\Eloquent\EloquentDoctorSpecialistRepository;

class DoctorSpecialistProvider extends ServiceProvider
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
        $this->app->bind('App\\Repositories\\DoctorSpecialistRepository', function(){
            $repository = new EloquentDoctorSpecialistRepository(new DoctorSpecialist());

            if ( ! env('APP_CACHE', false) ) {
                return $repository;
            }
            return new DoctorSpecialistCacheDecorator($repository);
        });
    }
}
