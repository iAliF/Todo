<?php

namespace App\Http\Controllers;

use App\Enums\TodoStatus;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    public function index()
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

    public function store(Request $request) {
        $user = $request->user();
        $validated = $request->validate([
            'content' => 'required|min:3',
            'status' => ['required', Rule::enum(TodoStatus::class)]
        ]);

        Todo::create([
            'user_id' => $user->id,
            'content' => $validated['content'],
            'status' => $validated['status'],
        ]);

        return ["ok" => true];
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return ['ok' => true];
    }
}
