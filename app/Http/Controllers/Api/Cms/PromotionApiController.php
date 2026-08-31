<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Cms\PromotionResource;
use App\Models\Promotion;

class PromotionApiController extends Controller
{
    public function index()
    {
        $promotions = Promotion::query()
            ->where('is_active', true)
            ->latest()
            ->get();

        return PromotionResource::collection($promotions);
    }
}
