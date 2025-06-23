<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Services\Dashboard\TodoService;
use Illuminate\View\View;
use Throwable;

class TodoController extends Controller
{
    public function index(): View
    {
        $user = auth()->user()->load('todos');
        $todos = $user->todos;


        return view(
            'dashboard.index',
            [
                'todoList' => $todos->where('status', 'todo'),
                'inProgress' => $todos->where('status', 'in_progress'),
                'done' => $todos->where('status', 'done'),
            ]
        );
    }

    /**
     * @throws Throwable
     */
    public function store(TodoRequest $request, TodoService $service): array
    {
        $todo = $service->store($request);

        return [
            "ok" => true,
            "data" => view('components.todo.item', ['todo' => $todo])->render()
        ];
    }

    /**
     * @throws Throwable
     */
    public function update(TodoRequest $request, Todo $todo): array
    {
        $validated = $request->validated();
        $todo->update($validated);

        return [
            "ok" => true,
            "data" => view('components.todo.item', ['todo' => $todo])->render(),
        ];
    }

    public function destroy(Todo $todo): array
    {
        $todo->delete();
        return ['ok' => true];
    }
}
