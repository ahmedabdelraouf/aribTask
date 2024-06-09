<?php

namespace App\Http\Controllers;

use App\Http\Requests\departments\DepartmentRequest;
use App\Models\Department;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

/**
 * DepartmentController
 *
 * This controller handles CRUD operations for Department resources.
 */
class DepartmentController extends Controller
{
    /**
     * Display a listing of departments.
     *
     * @return Application|Factory|\Illuminate\Contracts\Foundation\Application|View
     * @throws AuthorizationException
     */
    public function index(): View|Factory|Application|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('viewAny', Department::class);
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new department.
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     * @throws AuthorizationException
     */
    public function create(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('create', Department::class);
        return view('departments.create');
    }

    /**
     * Store a newly created department in storage.
     *
     * @param DepartmentRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(DepartmentRequest $request): RedirectResponse
    {
        $this->authorize('create', Department::class);
        $validated = $request->validated();
        Department::create($validated);
        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    /**
     * Show the form for editing the specified department.
     *
     * @param Department $department
     * @return \Illuminate\Contracts\Foundation\Application|Application|Factory|View
     * @throws AuthorizationException
     */
    public function edit(Department $department): \Illuminate\Contracts\Foundation\Application|Factory|View|Application
    {
        $this->authorize('update', $department);
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified department in storage.
     *
     * @param DepartmentRequest $request
     * @param Department $department
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(DepartmentRequest $request, Department $department): RedirectResponse
    {
        $this->authorize('update', $department);
        $validated = $request->validated();
        $department->update($validated);
        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    /**
     * Remove the specified department from storage.
     *
     * @param Department $department
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Department $department): RedirectResponse
    {
        $this->authorize('delete', $department);
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}
