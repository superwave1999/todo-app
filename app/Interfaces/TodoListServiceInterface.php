<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;

interface TodoListServiceInterface
{
    public function getUserLists(int $userId): Collection;
}
