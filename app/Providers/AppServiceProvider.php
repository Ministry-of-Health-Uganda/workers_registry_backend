<?php

namespace App\Providers;

use App\Repositories\IPractionerRepo;
use App\Repositories\PractionerRepo;
use App\Services\HttpService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(HttpService::class,function($app){
            return new HttpService();
        });

        $this->app->singleton(IPractionerRepo::class,function($app){
            return new PractionerRepo( $app->make(HttpService::class) );
        });
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
