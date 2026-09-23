<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Cms\FacilityServiceResource;
use App\Models\FacilityService;
use Illuminate\Support\Facades\Cache;

class FacilityServiceApiController extends Controller
{
    /**
     * Mengembalikan daftar fasilitas & layanan yang aktif,
     * diurutkan berdasarkan sort_order lalu name.
     */
    public function index()
    {
        $facilities = Cache::remember('rs_web_cms_api_facility_services', now()->addHours(6), function () {
            return FacilityService::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get();
        });

        return FacilityServiceResource::collection($facilities);
    }

    public function show($slug)
    {
        $facility = FacilityService::query()
            ->where('is_active', true)
            ->where('slug', $slug)
            ->firstOrFail();

        return new FacilityServiceResource($facility);
    }
}
