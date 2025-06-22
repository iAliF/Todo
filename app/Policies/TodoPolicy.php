<?php

namespace App\Policies;

use App\Models\Todo;
use App\Models\User;

class TodoPolicy
{
    public function edit(User $user, Todo $todo): bool
    {
        return $user->id === $todo->user_id;
    }
}
