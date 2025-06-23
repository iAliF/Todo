<?php

namespace App\Services\Auth;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginService
{
    public function attemptToLogin(UserLoginRequest $request): void {
        $validated = $request->validated();

        $loggedIn = Auth::attempt($validated);
        if (!$loggedIn) {
            throw ValidationException::withMessages([
                "phone" => ['The provided credentials are incorrect.']
            ]);
        }

        $request->session()->regenerate(); // Regenerate session token
    }
}
