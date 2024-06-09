<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('employees/search', [EmployeeController::class, 'search'])->name('employees.search')->middleware('auth');
Route::resource('employees', EmployeeController::class)->middleware('auth');
