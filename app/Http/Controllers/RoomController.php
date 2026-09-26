<?php

namespace App\Http\Controllers;

use App\Services\HospitalApiService;

class RoomController extends Controller
{
    public function __construct(
        protected HospitalApiService $apiService
    ) {}

    /**
     * Menampilkan halaman Ruang Perawatan dengan data dari CMS local API.
     */
    public function index()
    {
        $roomsData = $this->apiService->getRoomFacilities();

        // Pisahkan ruangan berdasarkan kategori untuk mempermudah rendering di view
        // Data dari API berupa associative array, kita cast ke (object) agar
        // di Blade bisa menggunakan sintaks $room->name
        $premiumRooms  = collect($roomsData)
                            ->where('category', 'premium')
                            ->map(fn($item) => (object) $item)
                            ->values();
                            
        $standardRooms = collect($roomsData)
                            ->where('category', 'standard')
                            ->map(fn($item) => (object) $item)
                            ->values();

        return view('ruang-perawatan.index', compact(
            'roomsData',
            'premiumRooms',
            'standardRooms'
        ));
    }

    /**
     * Menampilkan halaman detail khusus untuk satu Ruang Perawatan.
     */
    public function show($slug)
    {
        $roomsData = $this->apiService->getRoomFacilities();
        $room = collect($roomsData)->firstWhere('slug', $slug);

        if (!$room) {
            abort(404, 'Ruang Perawatan tidak ditemukan.');
        }

        // Cast ke object agar seragam penggunaannya di blade ($room->name)
        $room = (object) $room;

        return view('ruang-perawatan.show', compact('room'));
    }
}
