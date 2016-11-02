<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Contracts\UserRepositoryInterface', 'App\Repositories\Eloquent\UserRepository');
        $this->app->bind('App\Repositories\Contracts\OwnerRepositoryInterface', 'App\Repositories\Eloquent\OwnerRepository');
        $this->app->bind('App\Repositories\Contracts\PetRepositoryInterface', 'App\Repositories\Eloquent\PetRepository');
        $this->app->bind('App\Repositories\Contracts\VisitRepositoryInterface', 'App\Repositories\Eloquent\VisitRepository');
        $this->app->bind('App\Repositories\Contracts\VetRepositoryInterface', 'App\Repositories\Eloquent\VetRepository');
    }
}
