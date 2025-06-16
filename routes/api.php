<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiSlotController;
use App\Http\Controllers\AdminSlotObstacleController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\Api\ApiLogParkirController;

use App\Http\Controllers\Api\ApiRealtimeController;
use App\Http\Controllers\Api\ApiStatistikController;
use Illuminate\Support\Facades\DB;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/update-slot', [AdminSlotObstacleController::class, 'updateSlot']);

Route::post('/transaksi', [TransaksiController::class, 'store']);



//---------------------------------------------------------------------------------------------------------------------------------------------------------------------
//dari garis itu sampai ke bawah itu uda bisa realtime ke web


//realtime //masi ad kurang harusnya saaat app.py di run camera langsung mulai aj tampa harus di selec subzona kerena dan saat selec sub zona a camera di sub zona b berhendi detec kendaraan
Route::get('/zona-slot', [ApiRealtimeController::class, 'getZonaslot']);
Route::get('/get-subzonas/{zonaId}', [ApiRealtimeController::class, 'getSubzonas']);
Route::get('/subzona/{id}/detail', [ApiRealtimeController::class, 'getSubzonaDetails']);
Route::get('/real-time/subzona/{subzonaId}', [ApiRealtimeController::class, 'getSubzonaDetails'])->name('realTime.subzonaDetails');
Route::post('/update-status-slot', [ApiRealtimeController::class, 'updateSlotStatus']);
Route::get('/get-camera-id/{subzonaId}', [ApiRealtimeController::class, 'getCameraIdBySubzona']);
Route::get('/list-subzona', [ApiRealtimeController::class, 'getAllSubzonas']);

//ptinr log slot tapi untuk durasi masuk belum di kasi jeda
Route::post('/log-parkir/masuk', [ApiLogParkirController::class, 'masuk']);
Route::post('/log-parkir/keluar', [ApiLogParkirController::class, 'keluar']);

//statistik dg
Route::get('/statistik-zona', [ApiStatistikController::class,'getStatistik']);

