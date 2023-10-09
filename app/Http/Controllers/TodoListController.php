<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoListSaveRequest;
use App\Http\Requests\TodoListShareRequest;
use App\Http\Resources\TodoListDetailResource;
use App\Http\Resources\TodoListResource;
use App\Interfaces\TodoListServiceInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TodoListController extends Controller
{
    public function __construct(
        private readonly TodoListServiceInterface $service
    ) {
    }

    public function index(): AnonymousResourceCollection
    {
        $lists = $this->service->getUserLists(Auth::id());

        return TodoListResource::collection($lists);
    }

    public function store(TodoListSaveRequest $request): TodoListDetailResource
    {
        $created = $this->service->createUserList(Auth::id(), $request->validated());

        return new TodoListDetailResource($created);
    }

    public function show(string $id): TodoListDetailResource
    {
        $list = $this->service->getUserList(Auth::id(), $id);

        return new TodoListDetailResource($list);
    }

    public function update(TodoListSaveRequest $request, string $id): TodoListDetailResource
    {
        $list = $this->service->updateUserList(Auth::id(), $id, $request->validated());

        return new TodoListDetailResource($list);
    }

    public function destroy(string $id): Response
    {
        $this->service->deleteUserList(Auth::id(), $id);

        return response()->noContent();
    }

    public function markComplete(string $id): Response
    {
        $this->service->markListItemsComplete(Auth::id(), $id);

        return response()->noContent();
    }

    public function shareWithUser(TodoListShareRequest $request, string $id): Response
    {
        $this->service->shareListWithUser(Auth::id(), $id, $request->email);

        return response()->noContent();
    }
}
