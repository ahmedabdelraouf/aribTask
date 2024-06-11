<?php
// In app/Policies/UserPolicy.php

namespace App\Policies;

use App\Models\User;

class UserPolicy
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
        return $user->hasRole('admin') || $user->hasRole('manager');
    }

    public function delete(User $user)
    {
        return $user->hasRole('admin');
    }
}
