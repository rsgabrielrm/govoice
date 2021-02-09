<?php


namespace App\Providers;


use App\Services\NumberPreference\NumberPreferenceService;
use App\Services\NumberPreference\NumberPreferenceServiceContract;
use Illuminate\Support\ServiceProvider;

class NumberPreferenceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            NumberPreferenceServiceContract::class,
            NumberPreferenceService::class
        );
    }

    /**
     * Bootstrap services.
     *
     */
    public function provides()
    {
        return [
            NumberPreferenceServiceContract::class
        ];
    }
}
