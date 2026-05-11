<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        // Role-based access gates
        Gate::define('admin', function (User $user) {
            return $user->role === 'admin_sparepart';
        });

        Gate::define('manager', function (User $user) {
            return $user->role === 'service_manager';
        });

        Gate::define('admin-or-manager', function (User $user) {
            return in_array($user->role, ['admin_sparepart', 'service_manager']);
        });
    }
}

