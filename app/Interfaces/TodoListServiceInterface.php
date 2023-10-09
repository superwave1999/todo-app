<?php

namespace App\Interfaces;

use App\Models\TodoList;
use Illuminate\Support\Collection;

interface TodoListServiceInterface
{
    public function getUserLists(int $userId): Collection;

    public function getUserList(int $userId, int $listId): TodoList;

    public function deleteUserList(int $userId, int $listId): int;

    public function createUserList(int $userId, array $requestData): TodoList;

    public function updateUserList(int $userId, int $listId, array $requestData): TodoList;

    public function markListItemsComplete(int $userId, string $id): void;

    public function shareListWithUser(int $userId, string $id, mixed $email): void;
}
