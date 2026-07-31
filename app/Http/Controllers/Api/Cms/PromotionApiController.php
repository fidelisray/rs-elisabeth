<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PromotionApiController extends Controller
{
    public function index()
    {
        $promotions = \App\Models\Promotion::where('is_active', true)->latest()->get();
        $promotions->transform(function ($item) {
            if ($item->image_path) {
                $item->image_url = url(\Illuminate\Support\Facades\Storage::url($item->image_path));
            }
            return $item;
        });
        return response()->json($promotions);
    }
}
