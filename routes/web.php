<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HospitalController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('home');
});


// Halmaan Promotions
Route::get('/promotions', [HospitalController::class, 'getPromotions'])->name('getPromotions');