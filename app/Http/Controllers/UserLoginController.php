<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function destroy() {
        Auth::logout();

        return to_route('home');
    }
}
