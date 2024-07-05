<?php

namespace App\Providers;

use App\Interfaces\AddressRepositoryInterface;
use App\Interfaces\PersonRepositoryInterface;
use App\Repositories\AddressRepository;
use App\Repositories\PersonRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
        $this->app->bind(PersonRepositoryInterface::class, PersonRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
