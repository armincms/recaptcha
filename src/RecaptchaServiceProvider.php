<?php

namespace Armincms\Recaptcha;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider; 
use Laravel\Nova\Nova;

class RecaptchaServiceProvider extends ServiceProvider implements DeferrableProvider
{  
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Nova::resources([
            Recaptcha::class,
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    /**
     * Get the events that trigger this service provider to register.
     *
     * @return array
     */
    public function when()
    {
        return [
            \Laravel\Nova\Events\ServingNova::class,
        ];
    }
}
