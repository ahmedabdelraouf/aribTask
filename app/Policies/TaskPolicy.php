<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function viewAny(User $user)
    {
        return $user->hasRole('admin') || $user->hasRole('manager') || $user->hasRole('employee');
    }

    public function view(User $user)
    {
        return $user->hasRole('admin') || $user->hasRole('manager') || $user->hasRole('employee');
    }

    public function create(User $user)
    {
        return $user->hasRole('admin') || $user->hasRole('manager');
    }

    public function update(User $user)
    {
        return $user->hasRole('admin') || $user->hasRole('manager') || $user->hasRole('employee');
    }

    public function delete(User $user, Task $task)
    {
        return $user->hasRole('admin');
    }
}
