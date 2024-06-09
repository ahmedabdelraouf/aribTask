<!-- resources/views/employees/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Employee</h1>
        <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('employees._form')
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
