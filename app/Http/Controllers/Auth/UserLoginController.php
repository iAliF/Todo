<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Services\Auth\LoginService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserLoginController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(UserLoginRequest $request, LoginService $service): RedirectResponse
    {
        $service->attemptToLogin($request); // login or throw ValidationException
        return to_route('dashboard.index');
    }

    public function destroy(): RedirectResponse
    {
        Auth::logout();
        return to_route('login.create');
    }
}
