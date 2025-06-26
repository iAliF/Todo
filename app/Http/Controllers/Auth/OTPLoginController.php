<?php

namespace App\Http\Controllers\Auth;

use App\Facades\SMS;
use App\Http\Controllers\Controller;
use App\Http\Requests\OTPGenerateRequest;
use App\Http\Requests\OTPVerifyRequest;
use App\Services\Auth\OTPService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class OTPLoginController extends Controller
{
    public function create()
    {
        return view('auth.otp_login');
    }

    public function generate(OTPGenerateRequest $request, OTPService $otpService): RedirectResponse
    {
        $user = $request->getRuleUser();
        $code = $otpService->generateCode($user); // Generate the code
        if (!SMS::send($user->phone, $code, 'sms_ir')) { // Send code to user
            throw ValidationException::withMessages([
                "phone" => ['Could not send OTP code. Please try again.'],
            ]);
        }
        $otpService->saveToSession($user); // Send phone number to session

        return to_route('vc.verify');
    }

    public function verifyForm(): View|RedirectResponse
    {
        if (!session('phone')) {
            return redirect()->route('vc.create');
        }

        return view('auth.otp_verify', ['phone' => session('phone')]);
    }

    public function store(OTPVerifyRequest $request, OTPService $service): RedirectResponse
    {
        $user = $request->getRuleUser();
        $service->validate($request, $user); // Validate or throw ValidateException
        $service->login($request, $user); // Login User
        return to_route('dashboard.index');
    }
}
