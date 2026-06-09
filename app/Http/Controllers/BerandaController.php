<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BerandaController extends Controller
{
    //
    public function __construct(
        protected RumahSakitApiService $apiService
    ) {}

    public function index()
    {
        // Ambil semua data yang dibutuhkan landing page
        $dokterUnggulan = $this->apiService->getDaftarDokter([
            'unggulan' => true,
            'limit'    => 6,
        ]);

        $poliklinik = $this->apiService->getPoliklinik();
        $berita     = $this->apiService->getBeritaTerbaru(4);

        return view('beranda', compact('dokterUnggulan', 'poliklinik', 'berita'));
    }
}
