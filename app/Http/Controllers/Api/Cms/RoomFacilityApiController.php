<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Cms\RoomFacilityResource;
use App\Models\RoomFacility;
use Illuminate\Support\Facades\Cache;

class RoomFacilityApiController extends Controller
{
    /**
     * Mengembalikan daftar ruang perawatan yang aktif,
     * diurutkan berdasarkan sort_order, beserta URL foto.
     */
    public function index()
    {
        $rooms = Cache::remember('rs_web_cms_api_room_facilities', now()->addHours(6), function () {
            return RoomFacility::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get();
        });

        return RoomFacilityResource::collection($rooms);
    }

    public function show($slug)
    {
        $room = RoomFacility::query()
            ->where('is_active', true)
            ->where('slug', $slug)
            ->firstOrFail();

        return new RoomFacilityResource($room);
    }
}
