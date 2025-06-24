<?php

namespace App\Services\SMS;

use Illuminate\Support\Facades\Log;

class LogSMSService implements SMSService
{
    public function sendCode(string $to, int $code): bool
    {
        Log::debug("[{$to}] Login Code: {$code}");
        return true;
    }
}
