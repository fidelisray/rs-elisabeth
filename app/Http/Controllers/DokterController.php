<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokterController extends Controller
{
    //
    public function __construct(
        protected RumahSakitApiService $apiService
    ) {}

    public function index(Request $request)
    {
        $filters = $request->only(['spesialisasi', 'nama', 'page']);
        $dokter  = $this->apiService->getDaftarDokter($filters);

        return view('dokter.index', compact('dokter', 'filters'));
    }

    public function detail(int $id)
    {
        // Ambil detail + jadwal secara bersamaan (concurrent requests)
        [$detail, $jadwal] = [
            $this->apiService->getDokterById($id),
            $this->apiService->getJadwalDokter($id),
        ];

        abort_if(empty($detail), 404);

        return view('dokter.detail', compact('detail', 'jadwal'));
    }
}
