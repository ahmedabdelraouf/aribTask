<!-- resources/views/employees/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Department</h1>
        <form action="{{ route('departments.update', $department->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('departments._form')
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
