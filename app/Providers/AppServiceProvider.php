<?php

namespace App\Providers;

use App\Models\Department;
use App\Models\Employee;
use App\Policies\DepartmentPolicy;
use App\Policies\EmployeePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Employee::class => EmployeePolicy::class,
        Department::class => DepartmentPolicy::class,
    ];

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
        $this->register();

        Gate::define('manage-employees', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('manage-departments', function ($user) {
            return $user->hasRole('admin');
        });
    }
}
