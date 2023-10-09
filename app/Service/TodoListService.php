<?php

namespace App\Service;

use App\Interfaces\TodoListRepositoryInterface;
use App\Interfaces\TodoListServiceInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\TodoList;
use Illuminate\Support\Collection;

class TodoListService implements TodoListServiceInterface
{
    public function __construct(
        private readonly TodoListRepositoryInterface $repository,
        private readonly UserRepositoryInterface $userRepository
    ) {
    }

    public function getUserLists(int $userId): Collection
    {
        return $this->repository->getUserLists($userId);
    }

    public function getUserList(int $userId, int $listId): TodoList
    {
        return $this->repository->getUserList($userId, $listId);
    }

    public function deleteUserList(int $userId, int $listId): int
    {
        return $this->repository->deleteUserList($userId, $listId);
    }

    public function createUserList(int $userId, array $requestData): TodoList
    {
        return $this->repository->createUserList($userId, $requestData);
    }

    public function updateUserList(int $userId, int $listId, array $requestData): TodoList
    {
        return $this->repository->updateUserList($userId, $listId, $requestData);
    }

    public function markListItemsComplete(int $userId, string $id): void
    {
        $list = $this->repository->getUserList($userId, $id);
        $newItems = [];
        foreach ($list->items as $item) {
            $item['isComplete'] = true;
            $newItems[] = $item;
        }
        $list->items = $newItems;
        $list->save();
    }

    public function shareListWithUser(int $userId, string $id, mixed $email): void
    {
        $targetUser = $this->userRepository->getUserByEmail($email);
        $this->repository->addUserToList($userId, $id, $targetUser);
    }
}
