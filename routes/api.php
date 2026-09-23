<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1/cms')
    ->middleware('verifyCmsHmac')
    ->group(function () {
        Route::get('/news', [\App\Http\Controllers\Api\Cms\NewsApiController::class, 'index']);
        Route::get('/news/{slug}', [\App\Http\Controllers\Api\Cms\NewsApiController::class, 'show']);

        Route::get('/articles', [\App\Http\Controllers\Api\Cms\ArticleApiController::class, 'index']);
        Route::get('/articles/{id}', [\App\Http\Controllers\Api\Cms\ArticleApiController::class, 'show']);

        Route::get('/promotions', [\App\Http\Controllers\Api\Cms\PromotionApiController::class, 'index']);
        Route::get('/promotions/{id}', [\App\Http\Controllers\Api\Cms\PromotionApiController::class, 'show']);

        Route::get('/facilities', [\App\Http\Controllers\Api\Cms\FacilityServiceApiController::class, 'index']);
        Route::get('/facilities/{slug}', [\App\Http\Controllers\Api\Cms\FacilityServiceApiController::class, 'show']);

        // Room Facilities (Ruang Perawatan)
        Route::get('/room-facilities', [\App\Http\Controllers\Api\Cms\RoomFacilityApiController::class, 'index']);
        Route::get('/room-facilities/{slug}', [\App\Http\Controllers\Api\Cms\RoomFacilityApiController::class, 'show']);

        // Banner Promotions (Carousel Halaman Utama)
        Route::get('/banner-promotions', [\App\Http\Controllers\Api\Cms\BannerPromotionApiController::class, 'index']);
    });
