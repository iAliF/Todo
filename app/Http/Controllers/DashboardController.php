<?php

namespace App\Http\Controllers;

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
}
