<?php

namespace App\Http\Resources;

use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoListDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var TodoList $this */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'items' => $this->items
        ];
        // Here we usually want to include extra fields
    }
}
