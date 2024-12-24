<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/admin-home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin-home');
