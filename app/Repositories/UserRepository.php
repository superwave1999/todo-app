<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Carbon\Carbon;

class UserRepository implements UserRepositoryInterface
{

    public function updateLastLoggedIn(int $userId, Carbon $datetime): int
    {
        // I use query() to provide IDE completion
        return User::query()->whereKey($userId)->update(['last_logged_in_at' => $datetime]);
    }
}
