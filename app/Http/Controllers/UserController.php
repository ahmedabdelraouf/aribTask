<?php

namespace App\Http\Controllers;

use App\Http\Requests\users\StoreUserRequest;
use App\Http\Requests\users\UpdateUserRequest;
use App\Models\Department;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
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
        $this->authorize('viewAny', User::class);
        $users = User::with('manager')->get();
        $userRoles = User::$roles;
        $departments = Department::all();
        return view('users.index', compact('users', 'departments', 'userRoles'));
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     * @throws AuthorizationException
     */
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $this->authorize('create', User::class);
        $departments = Department::all();
        $roles = User::$roles;
        $managers = User::where('role',User::ROLE_MANAGER)->get();
        return view('users.create', compact('departments','managers','roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class);
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }
        User::create($validated);
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $departments = Department::all();
        $roles = User::$roles;
        $managers = User::where('role',User::ROLE_MANAGER)->get();
        return view('users.edit', compact('user', 'roles','departments','managers'));
    }


    /**
     * @throws AuthorizationException
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $this->authorize('update', $user);
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }
        $user->update($validated);
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function search(Request $request)
    {
        $name = $request->input('name');
        $managerName = $request->input('manager_name');
        $salaryFrom = $request->input('salary_from');
        $salaryTo = $request->input('salary_to');
        $department_id = $request->input('department_id');
        $role = $request->input('role');
        $userRoles = User::$roles;
        $users = User::query();
        if ($name) {
            $users->where(function ($query) use ($name) {
                $query->where('first_name', 'LIKE', "%{$name}%")
                    ->orWhere('last_name', 'LIKE', "%{$name}%");
            });
        }
        if ($role) {
            $users->where('role', $role);
        }
        if ($managerName) {
            $users->where('manager_name', 'LIKE', "%{$managerName}%");
        }
        if ($salaryFrom) {
            $users->where('salary', '>=', $salaryFrom);
        }
        if ($salaryTo) {
            $users->where('salary', '<=', $salaryTo);
        }
        if ($department_id) {
            $users->where('department_id', $department_id);
        }

        $users = $users->get();

        $departments = Department::all();
        return view('users.index', compact('users', 'departments', 'userRoles'));
    }
}
