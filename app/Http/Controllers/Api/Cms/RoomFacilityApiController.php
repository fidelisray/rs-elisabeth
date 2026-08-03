<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use App\Models\RoomFacility;
use Illuminate\Support\Facades\Storage;

class RoomFacilityApiController extends Controller
{
    /**
     * Mengembalikan daftar ruang perawatan yang aktif,
     * diurutkan berdasarkan sort_order, beserta URL foto.
     */
    public function index()
    {
        $rooms = RoomFacility::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $rooms->transform(function ($item) {
            // Generate full URL foto jika ada image_path
            if ($item->image_path) {
                $item->image_url = Storage::disk('public')->url($item->image_path);
            } else {
                $item->image_url = null;
            }
            return $item;
        });

        return response()->json($rooms);
    }
}
