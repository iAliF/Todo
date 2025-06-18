<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserLoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $loggedIn = Auth::attempt($validated);
        if (!$loggedIn) {
            ValidationException::withMessages([
                "email" => ['The provided credentials are incorrect.']
            ]);
        }

        $request->session()->regenerate();
        return to_route('home');
    }

    public function destroy()
    {
        Auth::logout();

        return to_route('home');
    }
}
