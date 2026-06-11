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
    Route::get('/',       [DokterController::class, 'index'])->name('index');
    Route::get('/{id}',   [DokterController::class, 'dokterByUnitId'])->name('dokterByUnitId');
    // Route::get('/{id}',   [DokterController::class, 'detail'])->name('detail')
    //      ->where('id', '[0-9]+');
});