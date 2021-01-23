<?php

namespace Armincms\Recaptcha;
 
use Illuminate\Support\ServiceProvider; 
use Laravel\Nova\Nova;

class RecaptchaServiceProvider extends ServiceProvider 
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function boot()
    { 
        Nova::serving(function() {
            Nova::resources([
                Recaptcha::class,
            ]); 
        });

        $this->app->booted(function($app) { 
            $app['config']->set('captcha.sitekey', Recaptcha::option('_recaptcha_sitekey_'));
            $app['config']->set('captcha.secret', Recaptcha::option('_recaptcha_secret_')); 
        });
    } 
}
