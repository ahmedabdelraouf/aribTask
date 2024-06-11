@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Users</h1>
        @can('create', \App\Models\User::class)
            <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add User</a>
        @endcan
        @include('users._form_search')
        @include("layouts.session_message")
        <table class="table">
            <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>email</th>
                <th>Salary</th>
                <th>Role</th>
                <th>manager</th>
                <th>Department</th>
                <th>Tasks</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="{{ $loop->index % 2 == 0 ? 'table-secondary' : '' }}">
                    <td>{{ $user->id }}</td>
                    <td><img src="{{ $user->image_url }}" style="width: 3rem;height: 3rem"> {{ $user->full_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->salary }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->manager->full_name??"" }}</td>
                    <td>{{$user->department->name??"None"}}</td>
                    <td>{{count($user->tasksCount)}}</td>
                    <td>

                        @can('update', \App\Models\User::class)
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                        @endcan

                        @can('delete', \App\Models\User::class)
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                  style="display:inline;"
                                  onsubmit="return confirm('Are you sure you want to delete this employee?');">
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
