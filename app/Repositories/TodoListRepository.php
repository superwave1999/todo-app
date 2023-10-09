<?php

namespace App\Repositories;

use App\Interfaces\TodoListRepositoryInterface;
use App\Models\TodoList;
use App\Models\TodoListItem;
use App\Models\User;
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
        //->whereHas('users', function (Builder $q) use ($userId) {
        //        $q->whereKey($userId);
        //    })
            ->orderBy('updated_at', 'DESC')
            ->get();
    }

    /**
     * This function queries to-do items that are
     * owned by or given ownership to the provided user.
     */
    public function getUserList(int $userId, int $listId): Builder|TodoList
    {
        return TodoList::query()
            //->whereHas('users', function (Builder $q) use ($userId) {
            //        $q->whereKey($userId);
            //    })
            ->whereKey($listId)
            ->firstOrFail();
    }

    public function deleteUserList(int $userId, int $listId): int
    {
        return TodoList::query()
            //->whereHas('users', function (Builder $q) use ($userId) {
            //        $q->whereKey($userId);
            //    })
            ->whereKey($listId)
            ->delete();
    }

    public function createUserList(int $userId, array $data): TodoList
    {
        $list = new TodoList();
        $list->fill($data);
        $list->save();
        return $list;
    }

    public function updateUserList(int $userId, int $listId, array $data): Builder|TodoList
    {
        $list = TodoList::query()
            ->whereKey($listId)
            ->firstOrFail();
        $list->fill($data);
        $list->save();
        return $list;
    }

    public function addUserToList(int $userId, int $listId, User $targetUser): void
    {
        $targetUser->todoLists()->syncWithoutDetaching([$listId]);
    }
}
