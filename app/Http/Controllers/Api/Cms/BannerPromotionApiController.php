<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use App\Models\BannerPromotion;
use Illuminate\Support\Facades\Storage;

class BannerPromotionApiController extends Controller
{
    /**
     * Mengembalikan daftar banner yang aktif, diurutkan berdasarkan sort_order.
     * URL gambar dikembalikan sebagai absolute URL agar bisa diakses langsung.
     */
    public function index()
    {
        $banners = BannerPromotion::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        $banners->transform(function ($item) {
            if ($item->image_path) {
                $item->image_url = url(Storage::disk('public')->url($item->image_path));
            } else {
                $item->image_url = null;
            }
            return $item;
        });

        return response()->json($banners);
    }
}
