<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HospitalApiService;
use Illuminate\Support\Facades\Storage;

class PromotionsController extends Controller
{
    public function __construct(
        protected HospitalApiService $apiService
    ) {}

    public function index(Request $request)
    {
        $promotionsData = $this->apiService->getPromotionsList();
        
        // Convert to object so blade template can use $promo->title
        $promotions = collect($promotionsData)->map(fn($item) => (object) $item)->values();

        return view('promotions.index', compact('promotions'));
    }

    public function savePhoto(string $base64Image, string $judul): string
    {
        $imageData = base64_decode($base64Image);

        $filename = "images/promotions/{$judul}.jpg";
        Storage::disk('public')->put($filename, $imageData);

        return $filename;
    }
}
