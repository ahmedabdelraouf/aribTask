<?php

namespace App\Http\Controllers;

use App\Http\Requests\tasks\StoreTaskRequest;
use App\Http\Requests\tasks\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     * @throws AuthorizationException
     */
    public function index(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $this->authorize('viewAny', User::class, Task::class);
        $user = Auth::user();
        $tasks = $this->getFilteredTasks($request, $user);
        $statuses = Task::$statuses;
        if ($user->hasRole('employee')) {
            $employees = User::select('id', 'first_name', 'last_name')->where('id', $user->id)->get();
        } else {
            $employees = User::select('id', 'first_name', 'last_name')->get();
        }
        return view('tasks.index', compact('statuses', 'employees', 'tasks'));
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     * @throws AuthorizationException
     */
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $this->authorize('create', Task::class);
        return $this->prepareFormData();
    }

    public function store(StoreTaskRequest $request)
    {
        $this->authorize('create', Task::class);
        $validated = $request->validated();
        Task::create($validated);
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    private function prepareFormData(Task $task = null): View|Factory|Application
    {
        $statuses = Task::$statuses;
        $user = Auth::user();
        if ($user->hasRole('employee')) {
            $employees = User::select('id', 'first_name', 'last_name')->where('id', $user->id)->get();
        } else {
            $employees = User::select('id', 'first_name', 'last_name')->where("role", User::ROLE_EMPLOYEE)->get();
        }
        return view(
            $task ? 'tasks.edit' : 'tasks.create',
            compact('statuses', 'employees', 'task')
        );
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return $this->prepareFormData($task);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $this->authorize('update', $task);
        $validated = $request->validated();
        $task->update($validated);
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function getFilteredTasks(Request $request, $user)
    {
        $subject = $request->input('subject');
        $status = $request->input('status');
        $employee_id = $request->input('employee_id');
        $tasks = Task::query();

        if ($user->hasRole('employee')) {
            $tasks->where('user_id', $user->id);
        }

        if ($subject) {
            $tasks->where(function ($query) use ($subject) {
                $query->where('subject', 'LIKE', "%{$subject}%");
            });
        }
        if ($employee_id) {
            $tasks->where('user_id', $employee_id);
        }

        if ($status) {
            $tasks->where('status', $status);
        }

        return $tasks->get();
    }
}
