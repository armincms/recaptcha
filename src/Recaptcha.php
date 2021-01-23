<?php

namespace Armincms\Recaptcha;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
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
            Text::make(__('Site Key'), '_recaptcha_site)')
                ->required(),
        ];
    }
}
