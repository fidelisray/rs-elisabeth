<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\StaffController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('home');
});

Route::get('/dokter', function() {
    return view('dokter');
});

// Beranda
Route::get('/', [BerandaController::class, 'index'])->name('beranda');

// Halaman Dokter
Route::prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/',       [DokterController::class, 'index'])->name('index');
    Route::get('/{id}',   [DokterController::class, 'detail'])->name('detail')
         ->where('id', '[0-9]+');
});

// Halmaan Staff
Route::get('/staff', [StaffController::class, 'index'])->name('staff');





Route::get('/halaman-jadwal', function() {
    return view('halamanjadwal');
});