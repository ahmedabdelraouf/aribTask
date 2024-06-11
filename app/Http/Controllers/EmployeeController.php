<?php

namespace App\Http\Controllers;

use App\Http\Requests\employees\StoreEmployeeRequest;
use App\Http\Requests\employees\UpdateEmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     * @throws AuthorizationException
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $this->authorize('viewAny', Employee::class);
        $employees = Employee::all();
        $departments = Department::all();
        return view('employees.index', compact('employees', 'departments'));
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     * @throws AuthorizationException
     */
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $this->authorize('create', Employee::class);
        $departments = Department::all();
        return view('employees.create',compact('departments'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        $this->authorize('create', Employee::class);
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }
        Employee::create($validated);
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function edit(Employee $employee)
    {
        $this->authorize('update', $employee);
        $departments = Department::all();
        return view('employees.edit', compact('employee','departments'));
    }


    /**
     * @throws AuthorizationException
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee): RedirectResponse
    {
        $this->authorize('update', $employee);
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $employee->update($validated);
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $this->authorize('delete', $employee);
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }

    public function search(Request $request)
    {
        $name = $request->input('name');
        $managerName = $request->input('manager_name');
        $salaryFrom = $request->input('salary_from');
        $salaryTo = $request->input('salary_to');
        $department_id = $request->input('department_id');
        $employees = Employee::query();
        if ($name) {
            $employees->where(function ($query) use ($name) {
                $query->where('first_name', 'LIKE', "%{$name}%")
                    ->orWhere('last_name', 'LIKE', "%{$name}%");
            });
        }
        if ($managerName) {
            $employees->where('manager_name', 'LIKE', "%{$managerName}%");
        }
        if ($salaryFrom) {
            $employees->where('salary', '>=', $salaryFrom);
        }
        if ($salaryTo) {
            $employees->where('salary', '<=', $salaryTo);
        }
        if ($department_id) {
            $employees->where('department_id', $department_id);
        }

        $employees = $employees->get();

        $departments = Department::all();
        return view('employees.index', compact('employees', 'departments'));
    }
}
