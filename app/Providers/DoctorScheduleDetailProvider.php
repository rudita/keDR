<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Cache\DoctorScheduleDetailCacheDecorator;
use App\Repositories\Eloquent\EloquentDoctorScheduleDetailRepository;
use App\Models\DoctorScheduleDetail;

class DoctorScheduleDetailProvider extends ServiceProvider
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
        $this->app->bind('App\\Repositories\\DoctorScheduleDetailRepository', function(){
            $repository = new EloquentDoctorScheduleDetailRepository(new DoctorScheduleDetail());

            if ( ! env('APP_CACHE', false) ) {
                return $repository;
            }
            return new DoctorScheduleDetailCacheDecorator($repository);
        });
    }
}
