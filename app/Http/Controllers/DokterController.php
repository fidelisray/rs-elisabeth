<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DoctorApiService;

class DokterController extends Controller
{
    //
    public function __construct(
        protected DoctorApiService $apiService
    ) {}

    public function index(Request $request)
    {
        // $filters = $request->only(['spesialisasi', 'nama', 'page']);
        $dokter  = $this->apiService->getDaftarDokter();

        // return view('dokter.index', compact('dokter', 'filters'));

        return view('dokter.index');
    }

    // public function detail(int $id)
    // {
    //     // Ambil detail + jadwal secara bersamaan (concurrent requests)
    //     [$detail, $jadwal] = [
    //         $this->apiService->getDokterById($id),
    //         $this->apiService->getJadwalDokter($id),
    //     ];

    //     abort_if(empty($detail), 404);

    //     return view('dokter.detail', compact('detail', 'jadwal'));
    // }
}
