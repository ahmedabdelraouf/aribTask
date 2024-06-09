<!-- resources/views/employees/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Employee</h1>
        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('employees._form')
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
