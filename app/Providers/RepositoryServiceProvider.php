<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\PackCategoryRepositoryInterface',
            'App\Repositories\PackCategoryRepository'
        );

        $this->app->bind(
            'App\Repositories\PackItemRepositoryInterface',
            'App\Repositories\PackItemRepository'
        );

        $this->app->bind(
            'App\Repositories\PackRepositoryInterface',
            'App\Repositories\PackRepository'
        );

        $this->app->bind(
            'App\Repositories\PackSeasonRepositoryInterface',
            'App\Repositories\PackSeasonRepository'
        );

        $this->app->bind(
            'App\Repositories\UserRepositoryInterface',
            'App\Repositories\UserRepository'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
