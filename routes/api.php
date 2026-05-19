<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\KampanyeIklanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/midtrans/callback', [KampanyeIklanController::class, 'callback']);


Route::prefix('device')->middleware('device.auth')->group(function () {
    Route::get('/sync', [DeviceController::class, 'sync']);
    Route::post('/heartbeat', [DeviceController::class, 'heartbeat']);
    Route::post('/impressions/batch', [DeviceController::class, 'uploadImpressions']);
});

Route::get('/asset/{asset_id}', [AssetController::class, 'download'])->name('asset.download');