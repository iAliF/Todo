<?php

namespace App\Providers;

use App\Services\SMS\KavenegarService;
use App\Services\SMS\LogSMSService;
use App\Services\SMS\SMSIrService;
use App\Services\SMS\SMSService;
use Illuminate\Support\ServiceProvider;

class SMSServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SMSService::class, function ($app) {
            return match (config('sms.default')) {
                'sms_ir' => new SMSIrService(),
                'kavenegar' => new KavenegarService(),
                default => new LogSMSService(),
            };
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
