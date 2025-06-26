<?php

return [
    'default' => env('SMS_PROVIDER', 'sms_ir'), // Default Provider
    'sms_ir' => [
        'template_id' => (int)env('SMSIR_TEMPLATE_ID', 636404),
    ],
    'kavenegar' => [
        'api_key' => env('KAVENEGAR_API_KEY', ''),
        'template_name' => env('KAVENEGAR_TEMPLATE_NAME', 'verify'),
    ]
];
