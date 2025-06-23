<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserRegisterController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(UserRegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $user = User::query()->create($validated);
        Auth::login($user);

        return to_route('dashboard.index');
    }
}
