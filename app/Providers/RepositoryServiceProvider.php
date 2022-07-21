<?php

namespace App\Providers;

use App\Interfaces\Auth\OfficeRepositoryInterface;
use App\Interfaces\Auth\RoleRepositoryInterface;
use App\Interfaces\Auth\UserRepositoryInterface;
use App\Interfaces\BaseEloquentInterface;
use App\Repositories\Auth\OfficeRepository;
use App\Repositories\Auth\RoleRepository;
use App\Repositories\Auth\UserRepository;
use App\Repositories\BaseEloquentRepository;
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
        $this->app->bind(BaseEloquentInterface::class,BaseEloquentRepository::class);
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(OfficeRepositoryInterface::class,OfficeRepository::class);
        $this->app->bind(RoleRepositoryInterface::class,RoleRepository::class);
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
