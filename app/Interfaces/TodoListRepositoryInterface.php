<?php

namespace App\Interfaces;

interface TodoListRepositoryInterface
{
    public function getUserLists(int $userId);
}
