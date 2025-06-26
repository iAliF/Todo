<?php

namespace App\Services\SMS;

use Illuminate\Support\Facades\Log;

class SMSManager
{
    protected array $drivers = [];

    public function send(string $to, int $code, ?string $driver = null): bool
    {
        /** @noinspection CallableParameterUseCaseInTypeContextInspection */
        $driver = $driver ?? config('sms.default');
        Log::debug("Sending OTP code to $to by $driver");
        return $this->getDriver($driver)->sendCode($to, $code);
    }

    protected function getDriver(string $name): SMSService
    {
        Log::debug('Were Here');
        if (!isset($this->drivers[$name])) {
            $this->drivers[$name] = match ($name) {
                'sms_ir' => new SMSIrService(),
                'kavenegar' => new KavenegarService(),
                default => new LogSMSService(),
            };
        }

        Log::debug('Were not Here');

        return $this->drivers[$name];
    }
}
