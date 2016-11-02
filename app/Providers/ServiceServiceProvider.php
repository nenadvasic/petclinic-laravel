<?php

namespace App\Providers;

use App\Repositories\Contracts\OwnerRepositoryInterface;
use App\Repositories\Contracts\PetRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\VetRepositoryInterface;
use App\Repositories\Contracts\VisitRepositoryInterface;
use App\Services\OwnerService;
use App\Services\PetService;
use App\Services\UserService;
use App\Services\VetService;
use App\Services\VisitService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Services\UserService', function ($app) {
            return new UserService($app->make(UserRepositoryInterface::class));
        });

        $this->app->bind('App\Services\OwnerService', function ($app) {
            return new OwnerService($app->make(OwnerRepositoryInterface::class));
        });

        $this->app->bind('App\Services\VetService', function ($app) {
            return new VetService($app->make(VetRepositoryInterface::class));
        });

        $this->app->bind('App\Services\PetService', function ($app) {
            return new PetService($app->make(PetRepositoryInterface::class));
        });

        $this->app->bind('App\Services\VisitService', function ($app) {
            return new VisitService($app->make(VisitRepositoryInterface::class));
        });
    }
}
