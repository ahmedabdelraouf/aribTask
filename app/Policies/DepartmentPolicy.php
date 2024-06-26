<?php
// In app/Policies/DepartmentPolicy.php

namespace App\Policies;

use App\Models\Department;
use App\Models\User;

class DepartmentPolicy
{

    public function viewAny(User $user)
    {
        return $user->hasRole('admin') || $user->hasRole('manager') || $user->hasRole('employee');
    }

    public function view(User $user)
    {
        return $user->hasRole('admin') || $user->hasRole('manager');
    }

    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    public function update(User $user)
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user)
    {
        return $user->hasRole('admin');
    }
}
