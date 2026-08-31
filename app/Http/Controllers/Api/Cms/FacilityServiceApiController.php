<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Cms\FacilityServiceResource;
use App\Models\FacilityService;

class FacilityServiceApiController extends Controller
{
    public function index()
    {
        $facilities = FacilityService::query()->latest()->get();

        return FacilityServiceResource::collection($facilities);
    }
}
