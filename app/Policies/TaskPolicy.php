<?php
// In app/Policies/EmployeePolicy.php

namespace App\Policies;

use App\Models\User;
use App\Models\Employee;

class EmployeePolicy
{

    public function viewAny(User $user)
    {
        return $user->hasRole('admin') || $user->hasRole('manager');
    }

    public function view(User $user, Employee $employee)
    {
        return $user->hasRole('admin') || $user->hasRole('manager') || $user->id === $employee->user_id;
    }

    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, Employee $employee)
    {
        return $user->hasRole('admin') || $user->id === $employee->user_id;
    }

    public function delete(User $user, Employee $employee)
    {
        return $user->hasRole('admin');
    }
}
