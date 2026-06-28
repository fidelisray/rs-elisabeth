<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokterController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('home');
});

// Route::get('/dokter', function() {
//     return view('dokter');
// });

// Halaman Dokter
Route::prefix('dokter')->name('dokter.')->group(function () {
    // Route::get('/',       [DokterController::class, 'index'])->name('index');
    Route::get('/', [DokterController::class, 'spesialisasi'])->name('index');
    Route::get('/init', [DokterController::class, 'dokterInit'])->name('dokterInit');
    Route::get('/{specialtyCode}',   [DokterController::class, 'dokterBySpesialisasi'])->name('dokterBySpesialisasi')
    ->where('specialtyCode', '[A-Z]{3}-[0-9]{2}');
    Route::get('/jadwal', function() {
        return view('dokter.jadwal-dokter');
    });
    Route::get('/all-dokter', [DokterController::class, 'allDokter'])->name('allDokter');
    // Route::get('/{id}',   [DokterController::class, 'dokterByUnitId'])->name('dokterByUnitId')
    // ->where('id', '[A-Z]{2}-[0-9]{2}');
    // Route::get('/{id}',   [DokterController::class, 'detail'])->name('detail')
    //      ->where('id', '[0-9]+');
});