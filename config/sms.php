<?php

return [
    'default' => env('SMS_PROVIDER', 'sms_ir'), // Default Provider

    'sms_ir' => [
        'template_id' => (int)env('SMSIR_TEMPLATE_ID', 636404),
    ]
];
