<?php

namespace App\Services\Auth;

use App\Http\Requests\OTPVerifyRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Random\RandomException;

class OTPService
{

    /**
     * @throws RandomException
     */
    public function generateCode(User $user, bool $save = true): int
    {
        $code = random_int(100_000, 999_999);

        if ($save) {
            $user->update([
                'code' => $code,
                'code_expire_at' => now()->addMinutes(2),
            ]);
        }

        return $code;
    }

    public function validate(OTPVerifyRequest $request, User $user): void
    {
        $code = (int)$request->validated()['code'];

        if ($code !== $user->code || !$user->code_expire_at || now()->gt($user->code_expire_at)) {

            throw ValidationException::withMessages([
                'code' => ['Invalid login code.'],
            ]);
        }
    }

    public function login(OTPVerifyRequest $request, User $user): void
    {
        $user->update([
            'code' => null,
            'code_expire_at' => now()->addMinutes(-1),
        ]);

        session()->forget('phone');
        Auth::login($user);
        $request->session()->regenerate();
    }

    public function saveToSession($user): void
    {
        session(['phone' => $user->phone]);
    }
}
