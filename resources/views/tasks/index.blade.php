@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tasks</h1>
        @can('create', \App\Models\Task::class)
            <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Add Task</a>
        @endcan
        @include("tasks._form_search")
        @include("layouts.session_message")
        <table class="table">
            <thead>
            <tr>
                <th>id</th>
                <th>subject</th>
                <th>Description</th>
                <th>Employee</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                    <?php
                    $name = "Not Assigned";
                    if (!empty($task->employee)) {
                        $name = $task->employee->full_name;
                    }
                    ?>
                <tr class="{{ $loop->index % 2 == 0 ? 'table-secondary' : '' }}">
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->subject }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{$name??""}}</td>
                    <td>{{ $task->status }}</td>
                    <td>
                        @can('update', $task)
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit And Assign to Employee</a>
                        @endcan

                        @can('delete', $task)
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this task?');">
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
