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
        // [$units, $dokter] = [
        //     $this->apiService->getDaftarUnits(),
        //     $this->apiService->getDaftarDokter(),
        // ];

        $units = $this->apiService->GetDaftarUnits();
        $doctors = $this->apiService->GetDaftarDokterByUnitId('PL-01');

        // return view('dokter.index', compact('dokter', 'filters'));

        return view('dokter.index', [
            'units' => $units,
            'doctors' => $doctors
        ]);
    }

    public function dokterByUnitId(string $id) {

        $doctors = $this->apiService->GetDaftarDokterByUnitId($id);

        return response()->json($doctors);
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
