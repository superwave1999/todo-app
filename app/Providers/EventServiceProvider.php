<?php

namespace App\Providers;

use App\Events\UserLoggedIn;
use App\Listeners\UpdateUserLastSeen;
use App\Models\TodoList;
use App\Observers\TodoListObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserLoggedIn::class => [
            UpdateUserLastSeen::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        TodoList::observe(TodoListObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
