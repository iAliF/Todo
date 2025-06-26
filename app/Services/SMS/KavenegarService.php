<?php

namespace App\Services\SMS;

use Kavenegar\Exceptions\ApiException;
use Kavenegar\Exceptions\HttpException;
use Kavenegar\KavenegarApi;

class KavenegarService implements SMSService
{

    protected KavenegarApi $api;
    protected string $templateName;

    public function __construct()
    {
        $this->api = new KavenegarApi(config('sms.kavenegar.api_key'));
        $this->templateName = config('sms.kavenegar.template_name');
    }

    public function sendCode(string $to, int $code): bool
    {
        try {
            $this->api->VerifyLookup(
                $to,
                $code,
                null,
                null,
                $this->templateName
            );
        } catch (ApiException | HttpException) {
            return false;
        }
    }
}
