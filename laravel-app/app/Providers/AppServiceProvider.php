<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        // Configurar zona horaria de Ecuador
        date_default_timezone_set(config('app.timezone'));
        
        // Configurar URL base para WAMP64
        if (app()->environment('local')) {
            // Forzar la URL base correcta para WAMP64
            URL::forceRootUrl('http://localhost/prueba/laravel-app/public');
        }
    }
}
