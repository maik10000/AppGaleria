<?php

namespace App\Providers;

use App\Http\Services\ManagerFiles;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
        $this->app->bind(ManagerFiles::class);
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
