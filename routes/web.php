<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('employees/search', [EmployeeController::class, 'search'])->name('employees.search');
    Route::resource('employees', EmployeeController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('tasks', \App\Http\Controllers\TaskController::class);
});
