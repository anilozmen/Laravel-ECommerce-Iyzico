<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
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

        Schema::defaultStringLength(191);

        // Form Component
        $this->app["form"]->component('bsText', 'form_components.text', ['name','label_name', 'value' => null, 'attributes' => []]);
        $this->app["form"]->component('bsFile', 'form_components.file', ['name','label_name']);
        $this->app["form"]->component('bsPassword', 'form_components.password', ['name','label_name', 'attributes' => []]);
        $this->app["form"]->component('bsSubmit', 'form_components.submit', ['name', 'url' => URL::previous()]);
        $this->app["form"]->component('bsCheckbox', 'form_components.checkbox', ['name', 'label_name', 'elements' => []]);
        $this->app["form"]->component('bsSelect', 'form_components.select', ['name', 'label_name','value','list' => [],"placeholder"]);
        $this->app["form"]->component('bsTextArea', 'form_components.textarea', ['name','label_name', 'value' => null, 'attributes' => []]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
