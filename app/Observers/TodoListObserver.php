<?php

namespace App\Observers;

use App\Models\TodoList;
use Illuminate\Support\Facades\Auth;

class TodoListObserver
{
    /**
     * Handle the TodoList "created" and "updated" events.
     */
    public function saving(TodoList $todoList): void
    {
        if (Auth::id()) {
            $todoList->last_modified_user_id = Auth::id();
        }
    }
}
