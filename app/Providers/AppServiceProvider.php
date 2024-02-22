<?php

namespace App\Providers;
use Illuminate\Support\Facades\Blade;
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
        Blade::directive('admin', function () {
            return "<?php if(auth()->user() && auth()->user()->is_admin): ?>";
        });

        Blade::directive('endadmin', function () {
            return "<?php endif; ?>";
        });

        Blade::directive('active', function () {
            return "<?php if(auth()->user() && auth()->user()->is_active): ?>";
        });

        Blade::directive('endactive', function () {
            return "<?php endif; ?>";
        });
    }
}
