<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('registrator', function(User $user) {
            return $user->role_id === 1 || $user->id === 597048;
        });

        Gate::define('distributor', function(User $user) {
            return $user->role_id === 2 || $user->id === 597048;
        });

        Gate::define('driver', function(User $user) {
            return $user->role_id === 3 || $user->id === 597048;
        });

        Gate::define('postman', function(User $user) {
            return $user->role_id === 4 || $user->id === 597048;
        });

        Gate::define('admin', function(User $user) {
            return $user->id === 597048;
        });
    }
}
