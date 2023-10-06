<?php

namespace App\Interfaces;

use Illuminate\Support\Carbon;

interface UserRepositoryInterface
{
    public function updateLastLoggedIn(int $userId, Carbon $datetime);
}
