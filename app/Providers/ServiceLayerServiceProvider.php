<?php

namespace App\Providers;

use App\Interfaces\TodoListServiceInterface;
use App\Service\TodoListService;
use Illuminate\Support\ServiceProvider;

class ServiceLayerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TodoListServiceInterface::class, TodoListService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
