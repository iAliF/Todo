<?php

namespace App\Services\SMS;


interface SMSService
{
    public function sendCode(string $to, int $code): bool;
}
