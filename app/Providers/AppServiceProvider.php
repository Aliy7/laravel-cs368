<?php

namespace App\Providers;
use App\Services\QuoteGeneratorService;
use Illuminate\Support\ServiceProvider;
use App\Services\QuoteGeneratorInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bindIf(QuoteGeneratorInterface::class, function ($app) {
            return new QuoteGeneratorService();
        });            
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
