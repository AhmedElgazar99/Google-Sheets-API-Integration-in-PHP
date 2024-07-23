<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
       // view()->share('ms', 'ADSs');
       //specify views
        view()->composer(['note.index','note.show'],function($view){
            $view->with('ms',"kdfbk");
        });
    }
}
