<?php

namespace App\Providers;

use App\Observers\PackItemObserver;
use App\Observers\PackObserver;
use App\Observers\UserObserver;
use App\Pack;
use App\PackItem;
use App\User;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

        // redis
        foreach ((array) Redis::connections() as $connection) {
            $connection->setEventDispatcher($this->app->make('events'));
        }

        Redis::enableEvents();

        // observers
        User::observe(UserObserver::class);
        Pack::observe(PackObserver::class);
        PackItem::observe(PackItemObserver::class);
    }
}
