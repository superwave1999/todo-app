<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateUserLastSeen implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    /**
     * Handle the event.
     */
    public function handle(UserLoggedIn $event): void
    {
        $this->userRepository->updateLastLoggedIn($event->uid, $event->datetime);
    }
}
