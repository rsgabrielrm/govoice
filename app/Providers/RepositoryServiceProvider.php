<?php

namespace App\Providers;

use App\Repositories\Customer\CustomerRepositoryContract;
use App\Repositories\Customer\CustomerRepositoryEloquent;
use App\Repositories\Number\NumberRepositoryContract;
use App\Repositories\Number\NumberRepositoryEloquent;
use App\Repositories\NumberPreference\NumberPreferenceRepositoryContract;
use App\Repositories\NumberPreference\NumberPreferenceRepositoryEloquent;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\User\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton(UserRepositoryContract::class, UserRepositoryEloquent::class);
        $this->app->singleton(CustomerRepositoryContract::class, CustomerRepositoryEloquent::class);
        $this->app->singleton(NumberRepositoryContract::class, NumberRepositoryEloquent::class);
        $this->app->singleton(NumberPreferenceRepositoryContract::class, NumberPreferenceRepositoryEloquent::class);

    }
}
