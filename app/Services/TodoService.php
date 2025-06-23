<?php

namespace App\Services;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;

class TodoService
{
    public function store(TodoRequest $request)
    {
        $validated = $request->validated();
        return Todo::create([
            'user_id' => $request->user()->id,
            'content' => $validated['content'],
            'status' => $validated['status'],
        ]);
    }
}
