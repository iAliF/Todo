<?php

namespace App\Http\Controllers;

use App\Rules\UserExists;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class OTPLoginController extends Controller
{
    public function create()
    {
        return view('auth.otp_login');
    }

    public function generate(Request $request): RedirectResponse
    {
        $rule = new UserExists();

        $validated = $request->validate([
            'phone' => ['required', 'numeric', $rule],
        ]);

        $code = random_int(100_000, 999_999);
        $rule->user->update([
            'code' => $code,
            'code_expire_at' => now()->addMinutes(2),
        ]);

        Log::debug("[{$validated['phone']}] Code => $code"); // Todo => Send SMS
        session(['phone' => $validated['phone']]);
        return to_route('vc.verify');
    }

    public function verifyForm(): View|RedirectResponse
    {
        if (!session('phone')) {
            return redirect()->route('vc.create');
        }

        return view('auth.otp_verify', ['phone' => session('phone')]);
    }

    public function store(Request $request): RedirectResponse
    {
        $rule = new UserExists();
        $validated = $request->validate([
            'phone' => ['required', 'numeric', $rule],
            'code' => ['required', 'numeric'],
        ]);
        $user = $rule->user;
        $code = (int) $validated['code'];

        if ($code !== $user->code) {
            throw ValidationException::withMessages([
                'code' => ['Invalid login code.'],
            ]);
        }
        $user->update([
            'code_expire_at' => now()->addMinutes(-1),
        ]);

        session()->forget('phone');
        Auth::login($user);
        $request->session()->regenerate();
        return to_route('dashboard.index');
    }
}
