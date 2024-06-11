<?php

namespace App\Http\Controllers;

use App\Http\Requests\tasks\StoreTaskRequest;
use App\Http\Requests\tasks\UpdateTaskRequest;
use App\Models\Employee;
use App\Models\Task;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     * @throws AuthorizationException
     */
    public function index(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $this->authorize('viewAny', Task::class);
        $tasks = $this->getFilteredTasks($request);
        $statuses = Task::$statuses;
        $employees = Employee::select('id', 'first_name', 'last_name')->get();
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
        $employees = Employee::select('id', 'first_name', 'last_name')->get();
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

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $task->update($validated);
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function getFilteredTasks(Request $request)
    {
        $subject = $request->input('subject');
        $status = $request->input('status');
        $employee_id = $request->input('employee_id');
        $tasks = Task::query();
        if ($subject) {
            $tasks->where(function ($query) use ($subject) {
                $query->where('subject', 'LIKE', "%{$subject}%");
            });
        }
        if ($employee_id) {
            $tasks->where('employee_id', $employee_id);
        }

        if ($status) {
            $tasks->where('status', $status);
        }

        return $tasks->get();
    }
}
