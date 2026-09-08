<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Cms\FacilityServiceResource;
use App\Models\FacilityService;

class FacilityServiceApiController extends Controller
{
    /**
     * Mengembalikan daftar fasilitas & layanan yang aktif,
     * diurutkan berdasarkan sort_order lalu name.
     */
    public function index()
    {
        $facilities = FacilityService::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return FacilityServiceResource::collection($facilities);
    }
}
