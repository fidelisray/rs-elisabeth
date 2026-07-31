<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FacilityServiceApiController extends Controller
{
    public function index()
    {
        $facilities = \App\Models\FacilityService::latest()->get();
        $facilities->transform(function ($item) {
            if ($item->icon_path) {
                $item->icon_url = url(\Illuminate\Support\Facades\Storage::url($item->icon_path));
            }
            return $item;
        });
        return response()->json($facilities);
    }
}
