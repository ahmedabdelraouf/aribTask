<?php

namespace App\Http\Controllers;
// app/Http/Controllers/EmployeeController.php
use App\Http\Requests\employees\StoreEmployeeRequest;
use App\Http\Requests\employees\UpdateEmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(StoreEmployeeRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        Employee::create($validated);
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }


    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $employee->update($validated);
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }

    public function search(Request $request)
    {
        $name = $request->input('name');
        $salaryFrom = $request->input('salary_from');
        $salaryTo = $request->input('salary_to');

        $employees = Employee::query();

        if ($name) {
            $employees->where(function ($query) use ($name) {
                $query->where('first_name', 'LIKE', "%{$name}%")
                    ->orWhere('last_name', 'LIKE', "%{$name}%");
            });
        }

        if ($salaryFrom) {
            $employees->where('salary', '>=', $salaryFrom);
        }

        if ($salaryTo) {
            $employees->where('salary', '<=', $salaryTo);
        }

        $employees = $employees->get();

        return view('employees.index', compact('employees'));
    }
}
