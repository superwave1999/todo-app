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
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        //TODO: Fix this.
        $lists = $this->service->getUserLists(Auth::id() ?? 11);
        return TodoListResource::collection($lists);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TodoListSaveRequest $request): TodoListDetailResource
    {
        $created = $this->service->createUserList(Auth::id() ?? 11, $request->validated());
        return new TodoListDetailResource($created);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): TodoListDetailResource
    {
        //TODO: Fix this.
        $list = $this->service->getUserList(Auth::id() ?? 11, $id);
        return new TodoListDetailResource($list);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TodoListSaveRequest $request, string $id): TodoListDetailResource
    {
        $list = $this->service->updateUserList(Auth::id() ?? 11, $id, $request->validated());
        return new TodoListDetailResource($list);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        //TODO: Fix this.
        $this->service->deleteUserList(Auth::id() ?? 11, $id);
        return response()->noContent();
    }

    public function markComplete(string $id): Response
    {
        $this->service->markListItemsComplete(Auth::id() ?? 11, $id);
        return response()->noContent();
    }

    public function shareWithUser(TodoListShareRequest $request, string $id): Response
    {
        $this->service->shareListWithUser(Auth::id() ?? 11, $id, $request->email);
        return response()->noContent();
    }
}
