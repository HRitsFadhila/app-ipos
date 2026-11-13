<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard-admin', function () {
    return view('admin.dashboard'); // atau buat file view sederhana yang meng-extend adminlte::page
});
