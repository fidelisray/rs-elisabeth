<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Cms\BannerPromotionResource;
use App\Models\BannerPromotion;

class BannerPromotionApiController extends Controller
{
    /**
     * Mengembalikan daftar banner yang aktif, diurutkan berdasarkan sort_order.
     * URL gambar dikembalikan sebagai absolute URL agar bisa diakses langsung.
     */
    public function index()
    {
        $banners = BannerPromotion::query()
            ->where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        return BannerPromotionResource::collection($banners);
    }
}
