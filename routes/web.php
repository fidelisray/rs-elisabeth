<?php

use Illuminate\Support\Facades\Route;
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

// Halmaan Staff
Route::get('/staff', [StaffController::class, 'index'])->name('staff');


Route::get('/halaman-jadwal', function() {
    return view('halamanjadwal');
});