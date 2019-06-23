<?php

namespace App\Providers;

use App\Models\BannerPromotion;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Cache\BannerPromotionCacheDecorator;
use App\Repositories\Eloquent\EloquentBannerPromotionRepository;

class BannerPromotionProvider extends ServiceProvider
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
        $this->app->bind('App\\Repositories\\BannerPromotionRepository', function(){
            $repository = new EloquentBannerPromotionRepository(new BannerPromotion());

            if ( ! env('APP_CACHE', false) ) {
                return $repository;
            }
            return new BannerPromotionCacheDecorator($repository);
        });
    }
}
