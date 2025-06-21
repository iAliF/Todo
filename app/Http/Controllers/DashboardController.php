<?php

namespace App\Http\Controllers;

use App\Models\Todo;

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

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return ['ok' => true];
    }
}
