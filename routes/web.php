<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RealTimeController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminZonaController;
use App\Http\Controllers\AdminAnalysisController;
use App\Http\Controllers\AdminApprovalController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AdminSlotController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\OnboardingController;

Route::get('/proxy-stream', function (\Illuminate\Http\Request $request) {
    $cameraId = $request->query('camera_id');
    $subzonaId = $request->query('subzona_id');
    $flaskUrl = "https://990d-103-164-80-99.ngrok-free.app/clean_video_feed?camera_id={$cameraId}&subzona_id={$subzonaId}";

    return response()->stream(function () use ($flaskUrl) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $flaskUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_WRITEFUNCTION, function ($ch, $data) {
            echo $data;
            flush();
            return strlen($data);
        });
        curl_exec($ch);
        curl_close($ch);
    }, 200, [
        'Content-Type' => 'multipart/x-mixed-replace; boundary=frame',
        'Cache-Control' => 'no-cache',
        'Connection' => 'keep-alive',
    ]);
});




// landing Page
Route::get('/', [LandingPageController::class, 'index'])->name('login');

//Autentikasi
Route::post('/login-proses', [AuthController::class, 'login_proses'])->name('login_proses');
Route::post('/registrasi-proses', [AuthController::class, 'registrasi_proses'])->name('registrasi_proses');
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->name('verification.verify');

//logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::middleware('role:pengguna')->group(function () {
        //Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        //Update Foto Kendaran
        Route::post('/simpan-kendaraan', [QrCodeController::class, 'storeVehicle'])->name('vehicle.store');
        Route::post('/profil/update-foto-kendaraan', [SettingsController::class, 'updateFotoKendaraan'])->name('profil.update.foto.kendaraan');

        //real rime
        Route::get('/real-time', [RealTimeController::class, 'index'])->name('real-time');

        //analysis
        Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik');

        // Onboarding
        Route::get('/onboarding', [OnboardingController::class, 'show'])->name('onboarding.show');
        Route::post('/onboarding/next', [OnboardingController::class, 'nextStep'])->name('onboarding.next');
        Route::post('/onboarding', [OnboardingController::class, 'update'])->name('onboarding.update');

        //ubah kata sandi
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
        Route::post('/change-password', [SettingsController::class, 'changePassword'])->name('change.password');


        //Email ubah kata sandi
        Route::get('/reset-password/{token}/{id}', [SettingsController::class, 'showResetForm'])->middleware('signed')->name('password.reset');
        Route::post('/send-reset-link', [SettingsController::class, 'sendResetLink'])->name('password.email');
        Route::post('/reset-password', [SettingsController::class, 'reset'])->name('password.update');

    });

    Route::middleware('role:admin')->group(function () {
        //admin
        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin-dashboard');
            // user
            Route::get('/users', [AdminUserController::class, 'index'])->name('admin-users');
            Route::delete('/users/{id_pengguna}', [AdminUserController::class, 'delete'])->name('users.delete');

            // search
            Route::get('/search', [SearchController::class, 'search'])->name('search');

            //aprove
            Route::get('/approval', [AdminApprovalController::class, 'index'])->name('admin-approval');
            Route::put('/approval/{id_pengguna}', [AdminApprovalController::class, 'updateUserStatus'])->name('update.userStatus');
            Route::put('/handleApproval/{id_kendaraan}', [AdminApprovalController::class, 'handleApproval'])->name('admin.handleApproval');

            // zona
            Route::get('/zona', [AdminZonaController::class, 'index'])->name('admin-zona');
            Route::post('/addZona', [AdminZonaController::class, 'store'])->name('zona.store');
            Route::put('/updateZona/{id_area}', [AdminZonaController::class, 'update'])->name('zona.update');
            Route::delete('/deleteZona/{id_area}', [AdminZonaController::class, 'destroy'])->name('zona.destroy');

            // Subzona
            Route::post('/addSubzona', [AdminZonaController::class, 'storeSubzona'])->name('subzona.store');
            Route::put('/updateSubzona/{id}', [AdminZonaController::class, 'updateSubzona'])->name('subzona.update');
            Route::delete('/deleteSubzona/{id}', [AdminZonaController::class, 'destroySubzona'])->name('subzona.destroy');

            // Slot
            Route::get('/slot/{zona?}', [AdminSlotController::class, 'index'])->name('admin-slot');
            Route::get('/slot/subzona/{subzonaId}', [AdminSlotController::class, 'getSlotsBySubzona'])->name('slot.getBySubzona');
            Route::post('/slot', [AdminSlotController::class, 'store'])->name('slot.store');
            Route::put('/slot/{id}', [AdminSlotController::class, 'update'])->name('slot.update');
            Route::delete('/slot/{id}', [AdminSlotController::class, 'destroy'])->name('slot.destroy');

            // Analysis
            Route::get('/analysis', [AdminAnalysisController::class, 'index'])->name('admin-analysis');
        });
    });
});
