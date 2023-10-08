<?php

namespace App\Repositories;

use App\Interfaces\TodoListRepositoryInterface;
use App\Models\TodoList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class TodoListRepository implements TodoListRepositoryInterface
{
    /**
     * This function queries to-do items that are
     * owned by or given ownership to the provided user.
     */
    public function getUserLists(int $userId): Collection
    {
        return TodoList::query()
            ->whereHas('users', function (Builder $q) use ($userId) {
                $q->whereKey($userId);
            })
            ->orderBy('updated_at', 'DESC')
            ->get();
    }
}
