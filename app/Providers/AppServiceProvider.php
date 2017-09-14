<?php

namespace App\Providers;

use App\Tracker\Messaging\SMSServiceInterface;
use App\Tracker\Messaging\TwilioSMSClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(SMSServiceInterface::class, TwilioSMSClient::class);
    }
}
