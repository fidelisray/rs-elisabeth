<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HospitalApiService;
use Illuminate\Support\Facades\Storage;

class HospitalController extends Controller
{
    //
    public function __construct(
        protected HospitalApiService $apiService
    ) {}

    public function getPromotions(Request $request)
    {
        $category = 'promo';

        $request = $this->apiService->GetPromotionsList($category);

        // $request = response()->json($request);

        // dd($request);

        // $data_response = [];
        // foreach ($request as $data) {
        //     $data_response .= [
        //         "judul" => $data->judul,
        //         "urlGambar" => $this->savePhoto($data['gambar'], $data['judul']), 
        //     ]
        // }

        // return response()->json($request);
        return view('pormotions', compact('request'));
    }


    public function savePhoto(string $base64Image, string $judul): string
    {
        // Buang prefix data URI kalau API mengirim dengan prefix
        // (kadang API mengirim "data:image/jpeg;base64,..." kadang cuma raw base64)
        // if (str_contains($base64Image, ',')) {
        //     $base64Image = explode(',', $base64Image)[1];
        // }

        $imageData = base64_decode($base64Image);

        $filename = "images/promotions/{$judul}.jpg";
        Storage::disk('public')->put($filename, $imageData);

        // dd(Storage::disk('public')->url($filename));

        return $filename;
    }
    
}
