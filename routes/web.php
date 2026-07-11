<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\GlossaryController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('home');
});


// Halmaan Promotions
Route::get('/promotions', [HospitalController::class, 'getPromotions'])->name('getPromotions');

// Glosarium
// Route::get('/kamus', [HospitalController::class, 'getKamusMedis'])->name('getKamusMedis');
// Route::prefix('kamus-medis')->name('glossary.')->group(function () {
Route::prefix('glosarium')->name('glossary.')->group(function () {
    Route::get('/',       [GlossaryController::class, 'index'])  ->name('index');
    // Route::get('/cari',   [GlossaryController::class, 'search']) ->name('search');
    
    Route::get('/glosary-gemini', [GlossaryController::class, 'tampil_data'])->name('gemini');
    // Rute untuk halaman daftar huruf A-Z
    Route::get('/diseases-conditions', [GlossaryController::class, 'gemini_index'])->name('gemini');
    // Rute untuk halaman detail penyakit (URL unik per penyakit)
    Route::get('/diseases-conditions/{slug}', [GlossaryController::class, 'gemini_show'])->name('gemini.show');
    
    
    Route::get('/cari',   [GlossaryController::class, 'search']) ->name('search');
    Route::get('/{term}', [GlossaryController::class, 'show'])   ->name('show');
});