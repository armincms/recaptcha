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
            $config = require __DIR__.'/config.php';

            foreach ($config as $key => $value) {
                $app['config']->set($key, $value);
            } 
        });
    } 
}
