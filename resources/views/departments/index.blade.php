@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Departments</h1>

        @can('create', \App\Models\User::class)
            <a href="{{ route('departments.create') }}" class="btn btn-primary mb-3">Add Department</a>
        @endcan

        @include("layouts.session_message")
        <table class="table">
            <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Total Employees</th>
                <th>Total Salaries</th>
                @if (Auth::user()->can('update', \App\Models\User::class) || Auth::user()->can('delete', \App\Models\User::class))
                    <th>Actions</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($departments as $department)
                <tr class="{{ $loop->index % 2 == 0 ? 'table-secondary' : '' }}">
                    <td>{{ $department->id }}</td>
                    <td>{{ $department->name }}</td>
                    <td>{{ $department->employees()->count() }}</td>
                    <td>{{ $department->salaries() }}</td>
                    <td>

                        @can('update', \App\Models\Department::class)
                            <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning">Edit</a>
                        @endcan

                        @can('delete', \App\Models\Department::class)
                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST"
                                  style="display:inline;"
                                  onsubmit="return confirm('Are you sure you want to delete this department?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endcan

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
