<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoTask;
use App\Http\Requests\TodoTaskUpdateRequest;
use App\Http\Resources\TodoTaskResource;

class TodoTaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function update(TodoTask $todoTask, TodoTaskUpdateRequest $request)
    {
        $this->authorize('update', $todoTask);
        $input = $request->validated();
        $todoTask->fill($input);
        $todoTask->save();

        return new TodoTaskResource($todoTask);
    }

    public function destroy(TodoTask $todoTask)
    {
        $this->authorize('delete', $todoTask);
        $todoTask->delete();
    }
}
