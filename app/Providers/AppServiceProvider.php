<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Redis;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        //Redis::enableEvents();

        // For previously resolved connections.
        foreach ((array) Redis::connections() as $connection) {
            $connection->setEventDispatcher($this->app->make('events'));
        }

// For new connections.
        Redis::enableEvents();
    }
}
