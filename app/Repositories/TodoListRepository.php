<?php

namespace App\Repositories;

use App\Interfaces\TodoListRepositoryInterface;
use App\Models\TodoList;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class TodoListRepository implements TodoListRepositoryInterface
{

    /**
     * Create a new query with user ownership protection.
     * @param int $userId
     * @return Builder
     */
    private function newQueryWithVisibility(int $userId): Builder
    {
        return TodoList::query()
            ->whereHas('users', function (Builder $q) use ($userId) {
                $q->whereKey($userId);
            });
    }

    public function getUserLists(int $userId): Collection
    {
        return $this->newQueryWithVisibility($userId)
            ->orderBy('updated_at', 'DESC')
            ->get();
    }

    public function getUserList(int $userId, int $listId): Builder|TodoList
    {
        return $this->newQueryWithVisibility($userId)
            ->whereKey($listId)
            ->firstOrFail();
    }

    public function deleteUserList(int $userId, int $listId): int
    {
        return $this->newQueryWithVisibility($userId)
            ->whereKey($listId)
            ->delete();
    }

    public function createUserList(int $userId, array $data): TodoList
    {
        $list = new TodoList();
        $list->fill($data);
        $list->save();
        $list->users()->attach($userId);
        return $list;
    }

    public function updateUserList(int $userId, int $listId, array $data): Builder|TodoList
    {
        $list = $this->newQueryWithVisibility($userId)
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
