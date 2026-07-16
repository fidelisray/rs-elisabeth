<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokterController;
// use App\Http\Controllers\HospitalController;
use App\Http\Controllers\PromotionsController;
use App\Http\Controllers\GlossaryController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('home.index');
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

// Halmaan Promotions
Route::prefix('promotions')->name('promotions.')->group(function () {
    Route::get('/', [PromotionsController::class, 'index'])->name('index');
});

// Glosarium
// Route::get('/kamus', [HospitalController::class, 'getKamusMedis'])->name('getKamusMedis');
// Route::prefix('kamus-medis')->name('glossary.')->group(function () {
Route::prefix('glosarium')->name('glossary.')->group(function () {
    Route::get('/',       [GlossaryController::class, 'index'])  ->name('index');
    Route::get('/cari',   [GlossaryController::class, 'search']) ->name('search');
    Route::get('/{term}', [GlossaryController::class, 'show'])   ->name('show');
});

Route::prefix('glosarium-gemini')->name('gemini.')->group(function () {
    Route::get('/tampil-data', [GlossaryController::class, 'tampil_data'])->name('tampil_data');
    Route::get('/', [GlossaryController::class, 'gemini_index'])->name('index');
    Route::get('/{slug}', [GlossaryController::class, 'gemini_show'])->name('show');
});