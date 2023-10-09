<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TodoList extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_modified_user_id',
        'items',
    ];

    protected $casts = [
        'items' => 'array',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(TodoList::class, 'todo_list_users', 'todo_list_id', 'user_id');
    }
}
