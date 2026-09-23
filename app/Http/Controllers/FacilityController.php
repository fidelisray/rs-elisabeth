<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HospitalApiService;

class FacilityController extends Controller
{
    public function index(HospitalApiService $apiService)
    {
        $facilities = collect($apiService->getFacilityServices());
        
        return view('facilities-and-services.index', compact('facilities'));
    }
}
