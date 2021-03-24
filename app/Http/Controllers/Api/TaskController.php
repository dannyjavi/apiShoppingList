<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::applySorts(request('sort'))->get();

        return TaskCollection::make($tasks);
    }

    public function store(Request $request)
    {
        $task = Task::create($request->all());

        return response()->json($task, 201);
    }

    public function show(Task $task)
    {
        return TaskResource::make($task);
    }

    public function update(Request $request, Task $task)
    {
        $task->update($request->all());

        return TaskResource::make($task);
    }

    public function delete(Task $task)
    {
        $task->delete();

        return response()->noContent();
    }
}
