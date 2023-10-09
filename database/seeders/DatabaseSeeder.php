<?php

namespace Database\Seeders;

use App\Models\TodoList;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        $users = collect();
        $users->add(User::factory()->create([
             'name' => 'Test User 1',
             'email' => 'test1@example.com',
        ]));
        $users->add(User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
        ]));
        $users->each(function (User $user) {
            $todo = TodoList::factory(4)->create();
            $user->todoLists()->saveManyQuietly($todo);
        });
    }
}
