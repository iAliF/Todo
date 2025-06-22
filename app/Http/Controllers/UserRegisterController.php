<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserRegisterController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse {
        $validated = $request->validate([
            'name' => ['required', 'min:6'],
            'phone' => ['required', 'numeric', 'digits:10', 'unique:users,phone'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = User::query()->create($validated);
        Auth::login($user);

        return redirect('/');
    }
}
