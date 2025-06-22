<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class UserLoginController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

        $loggedIn = Auth::attempt($validated);
        if (!$loggedIn) {
            throw ValidationException::withMessages([
                "phone" => ['The provided credentials are incorrect.']
            ]);
        }

        $request->session()->regenerate();
        return to_route('dashboard.index');
    }

    public function destroy(): RedirectResponse
    {
        Auth::logout();

        return to_route('home');
    }
}
