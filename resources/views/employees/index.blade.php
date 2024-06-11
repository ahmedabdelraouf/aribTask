@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Employees</h1>
        <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Add Employee</a>
        @include('employees._form_search')
        @include("layouts.session_message")
        <table class="table">
            <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Salary</th>
                <th>manager</th>
                <th>Department</th>
                <th>Tasks</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($employees as $employee)
                <tr class="{{ $loop->index % 2 == 0 ? 'table-secondary' : '' }}">
                    <td>{{ $employee->id }}</td>
                    <td><img src="{{ $employee->image_url }}"
                             style="width: 3rem;height: 3rem"> {{ $employee->full_name }}</td>
                    <td>{{ $employee->salary }}</td>
                    <td>{{ $employee->manager_name }}</td>
                    <td>{{$employee->department->name??"None"}}</td>
                    <td>{{count($employee->tasksCount)}}</td>
                    <td>
                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                              style="display:inline;"
                              onsubmit="return confirm('Are you sure you want to delete this employee?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
