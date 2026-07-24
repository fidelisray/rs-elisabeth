<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DoctorApiService;

class HomeController extends Controller
{
    public function __construct(
        protected DoctorApiService $apiService
    ) {}

    public function index()
    {
        $spesialisasi = $this->apiService->getCachedSpesialisasi();

        return view('home.index', compact('spesialisasi'));
    }
}
