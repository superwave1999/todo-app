<?php

namespace App\Interfaces;

use App\Models\TodoList;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

interface TodoListRepositoryInterface
{
    public function getUserLists(int $userId): Collection;

    public function getUserList(int $userId, int $listId): Builder|TodoList;

    public function deleteUserList(int $userId, int $listId): int;

    public function createUserList(int $userId, array $data): TodoList;

    public function updateUserList(int $userId, int $listId, array $data): Builder|TodoList;

    public function addUserToList(int $userId, int $listId, User $targetUser);
}
