<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HospitalApiService;

class StaffController extends Controller
{
    //
    public function __construct(
        protected HospitalApiService $apiService
    ) {}

    public function index(Request $request)
    {
        // $filters = $request->only(['spesialisasi', 'nama', 'page']);
        // $dokter  = $this->apiService->getDaftarDokter($filters);

        // return view('dokter.index', compact('dokter', 'filters'));

        $daftarStaff = $this->apiService->getDaftarStaff();

        dd($daftarStaff);

        return view('staff.index', compact('daftarStaff'));
    }

    
}
