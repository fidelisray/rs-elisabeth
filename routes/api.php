<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('cms')->group(function () {
    Route::get('/news', [\App\Http\Controllers\Api\Cms\NewsApiController::class, 'index']);
    Route::get('/news/{slug}', [\App\Http\Controllers\Api\Cms\NewsApiController::class, 'show']);
    
    Route::get('/articles', [\App\Http\Controllers\Api\Cms\ArticleApiController::class, 'index']);
    Route::get('/articles/{id}', [\App\Http\Controllers\Api\Cms\ArticleApiController::class, 'show']);
    
    Route::get('/promotions', [\App\Http\Controllers\Api\Cms\PromotionApiController::class, 'index']);
    
    Route::get('/facilities', [\App\Http\Controllers\Api\Cms\FacilityServiceApiController::class, 'index']);

    // Room Facilities (Ruang Perawatan) — CMS Baru
    Route::get('/room-facilities', [\App\Http\Controllers\Api\Cms\RoomFacilityApiController::class, 'index']);
});
