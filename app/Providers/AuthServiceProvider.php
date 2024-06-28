<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        try {
            $roleScopes = Role::all()->pluck('name', 'slug')->toArray();
            $permissionScopes = Permission::all()->pluck('name', 'slug')->toArray();

            $this->registerPolicies();
            Passport::tokensCan(array_merge($roleScopes, $permissionScopes));
            Passport::tokensExpireIn(now()->addHours(8));
        } catch (\Throwable $th) {
            // throw $th;
        }
    }
}
