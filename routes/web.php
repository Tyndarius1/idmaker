<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('admin');
Route::get('/student', [App\Http\Controllers\StudentController::class, 'student'])->name('student');
Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'employee'])->name('employee');

Route::get('/student-id/{studentId}', [App\Http\Controllers\StudentController::class, 'index'])->name('create');
Route::post('/save-student', [App\Http\Controllers\StudentController::class, 'saveStudent'])->name('create');
Route::get('/admin', [App\Http\Controllers\StudentController::class, 'adminHome'])->name('admin');
