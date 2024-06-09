<?php
// In app/Policies/TaskPolicy.php

namespace App\Policies;

use App\Models\User;
use App\Models\Task;

class TaskPolicy
{

    public function viewAny(User $user)
    {
        return $user->hasRole('admin') || $user->hasRole('manager');
    }

    public function view(User $user, Task $task)
    {
        return $user->hasRole('admin') || $user->hasRole('manager') || $user->id === $task->user_id;
    }

    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, Task $task)
    {
        return $user->hasRole('admin') || $user->id === $task->user_id;
    }

    public function delete(User $user, Task $task)
    {
        return $user->hasRole('admin');
    }
}
