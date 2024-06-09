@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Departments</h1>
        <a href="{{ route('departments.create') }}" class="btn btn-primary mb-3">Add Department</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($departments as $department)
                <tr class="{{ $loop->index % 2 == 0 ? 'table-secondary' : '' }}">
                    <td>{{ $department->id }}</td>
                    <td>{{ $department->name }}</td>
                    <td>
                        <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('departments.destroy', $department->id) }}" method="POST"
                              style="display:inline;"
                              onsubmit="return confirm('Are you sure you want to delete this department?');">
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
