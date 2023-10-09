<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Support\Carbon;

interface UserRepositoryInterface
{
    public function updateLastLoggedIn(int $userId, Carbon $datetime);

    public function getUserByEmail(string $email): User;
}
