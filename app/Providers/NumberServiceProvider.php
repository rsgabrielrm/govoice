<?php


namespace App\Providers;


use App\Services\Number\NumberService;
use App\Services\Number\NumberServiceContract;
use Illuminate\Support\ServiceProvider;

class NumberServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            NumberServiceContract::class,
            NumberService::class
        );
    }

    /**
     * Bootstrap services.
     *
     */
    public function provides()
    {
        return [
            NumberServiceContract::class
        ];
    }
}
