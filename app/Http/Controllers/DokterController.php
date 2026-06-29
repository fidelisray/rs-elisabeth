<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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

        return view('dokter.index', compact('units'));

        // return view('dokter.index', compact('dokter', 'filters'));

        // return view('dokter.index', [
        //     'units' => $units,
        //     'doctors' => $doctors
        // ]);
    }

    public function dokterByUnitId(string $id) {

        $doctors = $this->apiService->GetDaftarDokterByUnitId($id);

        return response()->json($doctors);
    }

    public function dokterInit() {
        $doctors = $this->apiService->GetDaftarDokterByUnitId('PL-01');

        return response()->json($doctors);
    }

    public function spesialisasi() {
        $spesialisasi = $this->apiService->getDaftarSpesialisasi();

        // dd($spesialisasi);

        return view("dokter.index", compact('spesialisasi'));
    }

    public function dokterBySpesialisasi(string $specialtyCode) {

        $doctors = $this->apiService->getDokterBySpesialisasi($specialtyCode);

        // dd(response()->json($doctors['Data']));
        // dd($doctors);

        return response()->json($doctors);
    }

    public function allDokter(Request $request): \Illuminate\Http\JsonResponse
    {

        $doctors = [];

        $data = Cache::get('all_doctors_grouped', []);

        if (empty($data)) { 
            echo "<h1>Data Belum Tersedia</h1>";
        }

        echo "<h1>Data Grouped</h1>";
        dd($data);

        // $this->apiService->fetchAndCacheAllDokter();
        // $spesialisasi = $this->apiService->getDaftarSpesialisasi();

        // foreach ($spesialisasi as $item) {
        //     $data = $this->apiService->getDokterBySpesialisasi($item->Code);

        //     if($data[0] !== 500) {
        //         dd($data);
        //     }
        // }

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
