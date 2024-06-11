<!-- resources/views/employees/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit user</h1>
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('users._form')
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
