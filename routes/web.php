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
    Route::get('/cari',   [GlossaryController::class, 'search']) ->name('search');
    Route::get('/{term}', [GlossaryController::class, 'show'])   ->name('show');
});