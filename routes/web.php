<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard-admin', function () {
    return view('admin.dashboard'); // atau buat file view sederhana yang meng-extend adminlte::page
});
Route::resource('categories', CategoryController::class);
