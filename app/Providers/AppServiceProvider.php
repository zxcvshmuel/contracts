<?php

namespace App\Providers;

use App\Models\Contract;
use App\Models\User;
use App\Observers\ContractObserver;
use App\Observers\UserObserver;
use App\Policies\UserPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        policy(UserPolicy::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Contract::observe(ContractObserver::class);
    }
}
