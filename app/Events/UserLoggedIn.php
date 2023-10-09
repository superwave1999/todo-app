<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class UserLoggedIn
{
    use Dispatchable, SerializesModels;

    public int $uid;

    public Carbon $datetime;

    /**
     * Create a new event instance.
     */
    public function __construct(int $uid, Carbon $datetime)
    {
        $this->uid = $uid;
        $this->datetime = $datetime;
    }
}
