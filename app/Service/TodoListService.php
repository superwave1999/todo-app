<?php

namespace App\Service;

use App\Interfaces\TodoListRepositoryInterface;
use App\Interfaces\TodoListServiceInterface;
use Illuminate\Support\Collection;

class TodoListService implements TodoListServiceInterface
{
    public function __construct(
        private readonly TodoListRepositoryInterface $repository
    ) {}

    public function getUserLists(int $userId): Collection
    {
        return $this->repository->getUserLists($userId);
    }
}
