<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Contacts;

class ContactsProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */

    //defer registration of this provider until it's needed
    protected $defer = true;
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('contacts', function ($app) {
            return new Contacts();
        });
    }
    public function provides(){
        return ['contacts'];
    }
}
