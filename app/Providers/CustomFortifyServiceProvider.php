<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;

class CustomFortifyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }




    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}



// use App\Providers\CustomFortifyServiceProvider;

// protected $providers = [
//     // ...
//     CustomFortifyServiceProvider::class,
// ];
