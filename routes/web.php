<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/google', [AuthController::class, 'redirectGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
});

Route::get('/board', [BoardController::class, 'index']);
Route::post('/board/store', [BoardController::class, 'store']);
Route::get('/board/detail', [BoardController::class, 'detail']);
Route::post('/board/update', [BoardController::class, 'update']);
Route::post('/board/delete-photo', [BoardController::class, 'deletePhoto']);
Route::post('/board/delete', [BoardController::class, 'delete']);
Route::post('/board/activate', [BoardController::class, 'activate']);
Route::get('/board/search', [BoardController::class, 'search']);

Route::get('/lokasi', [LokasiController::class, 'index']);
Route::post('/lokasi/store', [LokasiController::class, 'store']);
Route::get('/lokasi/detail', [LokasiController::class, 'detail']);
Route::post('/lokasi/update', [LokasiController::class, 'update']);
Route::post('/lokasi/delete-photo', [LokasiController::class, 'deletePhoto']);
Route::post('/lokasi/delete', [LokasiController::class, 'delete']);
Route::post('/lokasi/activate', [LokasiController::class, 'activate']);
Route::get('/lokasi/search', [LokasiController::class, 'search']);

Route::get('/client', [UserController::class, 'index']);
Route::post('/client/store', [UserController::class, 'store']);
Route::get('/client/detail', [UserController::class, 'detail']);
Route::post('/client/update', [UserController::class, 'update']);
Route::post('/client/delete', [UserController::class, 'delete']);
Route::post('/client/activate', [UserController::class, 'activate']);
Route::get('/client/search', [UserController::class, 'search']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    
});
