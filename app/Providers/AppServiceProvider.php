<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

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
        ///Log::info(request()->url()." || params :".json_encode(request()->all()));
        if (request()->header('lang' )=='en') {
            app()->setLocale('en');
        } else {
            \app()->setLocale('vn');
        }
    }
}
