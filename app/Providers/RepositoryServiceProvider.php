<?php

namespace App\Providers;

use App\Interfaces\TodoListRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\TodoListRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TodoListRepositoryInterface::class, TodoListRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
