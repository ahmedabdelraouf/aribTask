@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tasks</h1>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Add Employee</a>
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
                    $name = "none";
                    if(!empty($task->employee())){
                        $name = $task->employee()->first_name;
                    }
                        dd("dfvfd $name");
                    ?>
                <tr class="{{ $loop->index % 2 == 0 ? 'table-secondary' : '' }}">
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->subject }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{(!empty($task->employee()))??$task->employee()->first_name }}</td>
                    <td>{{ $task->status }}</td>
                    <td>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
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
