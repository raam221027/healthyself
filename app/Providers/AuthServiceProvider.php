<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;

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
        $this->registerPolicies();

        // Define roles and permissions
        // Permission::create(['name' => 'view dashboard', ]);
        // Permission::create(['name' => 'manage products']);
        // Add more permissions as needed

        // Create roles and assign permissions to them
        // $adminRole = Role::create(['name' => 'admin']);
        // $adminRole->givePermissionTo('view dashboard');
        // $adminRole->givePermissionTo('manage products');

        // Add more roles and assign permissions to them

        // Gate for admin role
        Gate::define('isAdmin', function ($user) {
            return $user->hasRole('admin');
        });
    }
}
    

