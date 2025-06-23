<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\OTPGenerateRequest;
use App\Http\Requests\OTPVerifyRequest;
use App\Services\Auth\OTPService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OTPLoginController extends Controller
{
    public function create()
    {
        return view('auth.otp_login');
    }

    public function generate(OTPGenerateRequest $request, OTPService $service): RedirectResponse
    {
        $user = $request->getRuleUser();
        $code = $service->generateCode($user); // Generate the code
        $service->send($user, $code); // Send code to user
        $service->saveToSession($user); // Send phone number to session

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
