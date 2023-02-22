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
        $input = $request->validated();
        $todo->fill($input)->save();

        return new TodoResource($todo->fresh());
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
    }

    public function addTask(Todo $todo, TodoTaskStoreRequest $request) 
    {
        $input = $request->validated();
        $todoTask = $todo->tasks()->create($input);

        return new TodoTaskResource($todoTask);
    }
}
