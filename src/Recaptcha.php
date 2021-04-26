<?php

namespace Armincms\Recaptcha;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\{Text, Select}; 
use Laravel\Nova\Http\Requests\NovaRequest;
use Armincms\Nova\ConfigResource;

class Recaptcha extends ConfigResource
{
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Select::make(__('Theme'), '_recaptcha_theme_')
                ->options([
                    'dark' => trans('recaptcha::dark'),
                    'light'=> trans('recaptcha::light'),
                ]),

            Text::make(__('Secret Key'), '_recaptcha_secret_')
                ->required(),
            Text::make(__('Site Key'), '_recaptcha_sitekey_')
                ->required(),
        ];
    }

    /**
     * Return the location to redirect the user after update.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Laravel\Nova\Resource  $resource
     * @return string
     */
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return tap(parent::redirectAfterUpdate($request, $resource), function() {
            ob_start();
            var_export(array_filter([
                'captcha.secret' => static::option('_recaptcha_secret_'),
                'captcha.sitekey' => static::option('_recaptcha_sitekey_'), 
            ]));
            $options = ob_get_clean();

            file_put_contents(__DIR__.'/config.php', '<?php return '.$options.';');
            
            \Artisan::call('config:cache');
        });
    }
}
