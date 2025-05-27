<?php

use App\Http\Controllers\AnggotaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DivisiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// DIVISI ROUTES
Route::get('/divisi', [DivisiController::class, 'index'])->middleware('auth:sanctum');
Route::post('/divisi', [DivisiController::class, 'store']);
Route::put('/divisi/edit/{id}', [DivisiController::class, 'update']);
Route::get('/divisi/{id}', [DivisiController::class, 'show']);
Route::delete('/divisi/{id}', [DivisiController::class, 'destroy']);

// ANGGOTA ROUTES
Route::get('/anggota', [AnggotaController::class, 'index']);
Route::get('/anggota/{id}', [AnggotaController::class, 'show']);
Route::post('/anggota', [AnggotaController::class, 'store']);
Route::put('/anggota/edit/{id}', [AnggotaController::class, 'update']);
Route::delete('/anggota/{id}', [AnggotaController::class, 'destroy']);