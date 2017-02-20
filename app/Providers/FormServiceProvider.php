<?php

namespace App\Providers;

use Form;
use Illuminate\Support\ServiceProvider;
use Collective\Html;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Form::component('bsText', 'components.bsform.text', ['name', 'label', 'required' => '', 'value' => null, 'attributes' => [], 'info' => null]);
        Form::component('bsTextarea', 'components.bsform.textarea', ['name', 'label', 'required' => '', 'value' => null, 'attributes' => [], 'info' => null]);
        Form::component('bsPassword', 'components.bsform.password', ['name', 'label', 'attributes' => [], 'info' => null]);
        Form::component('bsSelect', 'components.bsform.select', ['name', 'label', 'options', 'value' => null, 'attributes' => [], 'info' => null]);
        Form::component('bsSubmit', 'components.bsform.submit', ['text']);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
