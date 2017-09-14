<?php

namespace App\Providers;

use App\SMSServiceInterface;
use App\TwilioSMSClient;
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
        // @todo: tie to ENV
        app()->bind(SMSServiceInterface::class, TwilioSMSClient::class);
    }
}
