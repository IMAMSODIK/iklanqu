<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GetInTouchController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/get-in-touch/store', [GetInTouchController::class, 'store']);

Route::get('/auth/google', [AuthController::class, 'redirectGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
});

// admin
Route::get('/dashboard', [DashboardController::class, 'index'])->name('buat');
Route::get('/dashboard/lokasi', [DashboardController::class, 'lokasi'])->name('lokasi');
Route::get('/dashboard/riwayat', [DashboardController::class, 'riwayat'])->name('riwayat');
Route::get('/dashboard/pantau', [DashboardController::class, 'pantau'])->name('pantau');
Route::get('/dashboard/akun', [DashboardController::class, 'akun'])->name('akun');
Route::post('/dashboard/tutorial/selesai', [DashboardController::class, 'tutorialSelesai'])->name('akun');

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

Route::get('/client', [ClientController::class, 'index']);
Route::get('/client/detail', [ClientController::class, 'detail']);
Route::post('/client/delete', [ClientController::class, 'delete']);
Route::post('/client/activate', [ClientController::class, 'activate']);

Route::get('/user', [UserController::class, 'index']);
Route::post('/user/store', [UserController::class, 'store']);
Route::post('/user/update', [UserController::class, 'update']);
Route::post('/user/delete', [UserController::class, 'delete']);
// Route::post('/user/activate', [UserController::class, 'activate']);
// Route::get('/user/detail', [UserController::class, 'detail']);
// Route::get('/user/search', [UserController::class, 'search']);


Route::get('/profile', [ProfileController::class, 'index']);
Route::post('/profile', [ProfileController::class, 'store']);

Route::get('/get-in-touch', [GetInTouchController::class, 'index']);
Route::post('/get-in-touch/store', [GetInTouchController::class, 'store']);
Route::post('/get-in-touch/delete', [GetInTouchController::class, 'delete']);

Route::get('/logout',[AuthController::class,'logout'])->name('logout');

// Route::middleware(['auth'])->group(function () {
    

    
// });
