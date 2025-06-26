<?php

namespace App\Services\SMS;

use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\Log;
use Ipe\Sdk\Exceptions\SmsException;
use Ipe\Sdk\Facades\SmsIr;


class SMSIrService implements SMSService
{
    private int $templateId;

    public function __construct()
    {
        $this->templateId = config('sms.sms_ir.template_id');
    }


    public function sendCode(string $to, int $code): bool
    {

        try {
            $response = SmsIr::verifySend(
                $to,
                $this->templateId,
                [
                    [
                        "name" => "CODE",
                        "value" => $code
                    ]
                ]
            );
            return $response->status === 1 && $response->message === "موفق";
        } catch (SmsException | ConnectException $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

}
