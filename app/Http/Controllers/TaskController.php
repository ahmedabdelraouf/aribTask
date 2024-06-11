<?php

namespace App\Http\Controllers;

use App\Http\Requests\tasks\StoreTaskRequest;
use App\Http\Requests\tasks\UpdateTaskRequest;
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
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $this->authorize('viewAny', Task::class);
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     * @throws AuthorizationException
     */
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $this->authorize('create', Task::class);
        $statuses = Task::$statuses;
        return view('tasks.create',compact('statuses'));
    }

    public function store(StoreTaskRequest $request)
    {
        $this->authorize('create', Task::class);
        $validated = $request->validated();

        Task::create($validated);
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return view('tasks.edit', compact('task'));
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

    public function search(Request $request)
    {
        $subject = $request->input('subject');
        $status_id = $request->input('status_id');
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

        if ($status_id) {
            $tasks->where('status_id', $status_id);
        }

        $tasks = $tasks->get();

        return view('tasks.index', compact('tasks'));
    }
}
