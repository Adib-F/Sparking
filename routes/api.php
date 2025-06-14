<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiSlotController;
use App\Http\Controllers\AdminSlotObstacleController;
use App\Http\Controllers\TransaksiController;


use App\Http\Controllers\Api\ApiRealtimeController;
use App\Http\Controllers\Api\StatistikController;
use Illuminate\Support\Facades\DB;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/update-slot', [AdminSlotObstacleController::class, 'updateSlot']);

Route::post('/transaksi', [TransaksiController::class, 'store']);

//realtime
Route::get('/get-subzonas/{zonaId}', [ApiRealtimeController::class, 'getSubzonas']);
Route::get('/subzona/{id}/detail', [ApiRealtimeController::class, 'getDetail']);
Route::get('/real-time/subzona/{subzonaId}', [ApiRealTimeController::class, 'getSubzonaDetails'])->name('realTime.subzonaDetails');
Route::post('/update-status-slot', [ApiRealtimeController::class, 'updateSlotStatus']);
Route::get('/get-camera-id/{subzonaId}', [ApiRealtimeController::class, 'getCameraIdBySubzona']);


//satistik
Route::get('/statistik/harian', [StatistikController::class, 'statistikHarian']);
Route::get('/statistik/{zona_id}', [StatistikController::class, 'mingguan']);
Route::get('/get-zona-by-subzona/{id}', [StatistikController::class, 'getZonaBySubzona']);





