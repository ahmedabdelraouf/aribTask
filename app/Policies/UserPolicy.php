<?php
// In app/Policies/UserPolicy.php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{

    public function viewAny(User $user)
    {
        return $user->hasRole('admin') || $user->hasRole('manager');
    }

    public function view(User $user, User $employee)
    {
        return $user->hasRole('admin') || $user->hasRole('manager') || $user->id === $employee->user_id;
    }

    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, User $employee)
    {
        return $user->hasRole('admin') || $user->id === $employee->user_id;
    }

    public function delete(User $user, User $employee)
    {
        return $user->hasRole('admin');
    }
}
