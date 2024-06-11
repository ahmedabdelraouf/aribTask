<!-- resources/views/tasks/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Task</h1>
        @include("layouts.session_message")
        <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('tasks._form')
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
