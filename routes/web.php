<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/google', [AuthController::class, 'redirectGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/board', [BoardController::class, 'index']);
    Route::post('/board/store', [BoardController::class, 'store']);
    Route::get('/board/detail', [BoardController::class, 'detail']);
    Route::post('/board/update', [BoardController::class, 'update']);
    Route::post('/board/reset-password', [BoardController::class, 'resetPasssword']);
    Route::post('/board/delete', [BoardController::class, 'delete']);
    Route::post('/board/activate', [BoardController::class, 'activate']);
    Route::get('/board/search', [BoardController::class, 'search']);
    Route::get('/board/load-more', [BoardController::class, 'loadMore']);
});
