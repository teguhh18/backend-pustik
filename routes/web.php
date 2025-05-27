<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Test;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

// Route::post('/login', [Test::class, 'login']);