<?php

use App\Http\Controllers\KampanyeIklanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/midtrans/callback', [KampanyeIklanController::class, 'callback']);
