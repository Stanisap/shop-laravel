<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
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
        // this directive returns a class "active" for the active route
        Blade::directive('routeactive', function ($route) {
            return "<?php echo Route::currentRouteNamed($route) ? 'class=\"active\"' : ''?>";
        });
        //  this directive checks if the user has administrator rights and returns true or false
        Blade::if('admin', function () {
            return Auth::check() && Auth::user()->isAdmin();
        });
    }
}
