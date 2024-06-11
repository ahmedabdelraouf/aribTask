<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('employees/search', [EmployeeController::class, 'search'])->name('employees.search')->middleware('auth');
Route::resource('employees', EmployeeController::class)->middleware('auth');
Route::resource('departments', DepartmentController::class)->middleware('auth');
Route::resource('tasks', \App\Http\Controllers\TaskController::class)->middleware('auth');
