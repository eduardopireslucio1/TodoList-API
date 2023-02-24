<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoStoreRequest;
use App\Http\Requests\TodoTaskStoreRequest;
use App\Http\Requests\TodoUpdateRequest;
use App\Http\Resources\TodoResource;
use App\Http\Resources\TodoTaskResource;
use App\Models\Todo;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return TodoResource::collection(auth()->user()->todos);
    }

    public function show(Todo $todo)
    {
        $this->authorize('view', $todo);
        $todo->load('tasks');
        return new TodoResource($todo);
    }

    public function store(TodoStoreRequest $request)
    {
        $input = $request->validated();
        $todo = auth()->user()->todos()->create($input);

        return new TodoResource($todo);
    }

    public function update(Todo $todo, TodoUpdateRequest $request)
    {
        $this->authorize('update', $todo);
        $input = $request->validated();
        $todo->fill($input)->save();

        return new TodoResource($todo->fresh());
    }

    public function destroy(Todo $todo)
    {
        $this->authorize('destroy', $todo);
        $todo->delete();
    }

    public function addTask(Todo $todo, TodoTaskStoreRequest $request) 
    {
        $this->authorize('addTask', $todo);
        $input = $request->validated();
        $todoTask = $todo->tasks()->create($input);

        return new TodoTaskResource($todoTask);
    }
}
