<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Cms\RoomFacilityResource;
use App\Models\RoomFacility;

class RoomFacilityApiController extends Controller
{
    /**
     * Mengembalikan daftar ruang perawatan yang aktif,
     * diurutkan berdasarkan sort_order, beserta URL foto.
     */
    public function index()
    {
        $rooms = RoomFacility::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return RoomFacilityResource::collection($rooms);
    }
}
