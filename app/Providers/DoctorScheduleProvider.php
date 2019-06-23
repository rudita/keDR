<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Cache\DoctorScheduleCacheDecorator;
use App\Repositories\Eloquent\EloquentDoctorScheduleRepository;
use App\Models\DoctorSchedule;

class DoctorScheduleProvider extends ServiceProvider
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
        $this->app->bind('App\\Repositories\\DoctorScheduleRepository', function(){
            $repository = new EloquentDoctorScheduleRepository(new DoctorSchedule());

            if ( ! env('APP_CACHE', false) ) {
                return $repository;
            }
            return new DoctorScheduleCacheDecorator($repository);
        });
    }
}
