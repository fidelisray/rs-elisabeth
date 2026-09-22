<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Cms\PromotionResource;
use App\Models\Promotion;
use Illuminate\Support\Facades\Cache;

class PromotionApiController extends Controller
{
    public function index()
    {
        $page = request('page', 1);
        $version = Cache::rememberForever('rs_web_cms_api_promotions_version', fn() => time());
        
        $promotions = Cache::remember("rs_web_cms_api_promotions_v{$version}_page_{$page}", now()->addHours(2), function () {
            return Promotion::query()
                ->where('is_active', true)
                ->latest()
                ->paginate(12);
        });

        return PromotionResource::collection($promotions);
    }
}
