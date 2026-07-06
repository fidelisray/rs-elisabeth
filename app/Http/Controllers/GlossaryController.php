<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HospitalApiService;

class GlossaryController extends Controller
{
    //
    public function __construct(
        protected HospitalApiService $apiService
    ) {}

    
    /*
    public function index(Request $request) {

        $glosarium = $this->apiService->GetGlosarium();

        return view('glosarium', compact('glosarium'));
    } */

    /**
     * Halaman utama kamus medis
     */
    public function index(Request $request)
    {
        // Ambil filter huruf dari query string (?letter=A), default 'ALL'
        $activeLetter = strtoupper($request->query('letter', 'ALL'));
        
        // Validasi: harus huruf A-Z atau ALL
        if ($activeLetter !== 'ALL' && !preg_match('/^[A-Z]$/', $activeLetter)) {
            $activeLetter = 'ALL';
        }


        // Ambil data (dari cache kalau ada, dari API kalau tidak)
        // $glossary = $this->apiService->getGlossaryByLetter($activeLetter);
        $glossary = $this->apiService->getGlossaryGrouped($activeLetter);

        // Hitung huruf yang tersedia untuk navigasi A-Z
        $allItems       = $this->apiService->getGlosarium();
        $availableLetters = collect($allItems)
            ->map(fn($item) => strtoupper(substr($item['istilah'], 0, 1)))
            ->unique()
            ->sort()
            ->values()
            ->toArray();



        if ($activeLetter === 'ALL') {
            return view('glosarium.index', [
                'mode' => 'ads',
                'glossary' => null,
                'activeLetter' => 'ALL',
                'availableLetters' => null
            ]);
        } else {
    
            // return view('glossary.index', compact('glossary', 'activeLetter', 'availableLetters'));
    
            // return view('glosarium.index', compact('glossary', 'activeLetter', 'availableLetters'));
            return view('glosarium.index', [
                'mode' => 'glosarium',
                'glossary' => $glossary,
                'activeLetter' => $activeLetter,
                'availableLetters' => $availableLetters
            ]);
        }
    }

    /**
     * Detail satu istilah medis
     */
    public function show(string $term)
    {
        $all  = $this->apiService->getGlosarium();
        $item = collect($all)->firstWhere('istilah', urldecode($term));

        abort_if(!$item, 404, 'Istilah medis tidak ditemukan.');

        // dd($item);

        // return view('glossary.show', compact('item'));
        return view('glosarium.index', compact('item'));
    }

    /**
     * Search via AJAX (Fetch API dari frontend)
    */
    public function search(Request $request)
    {
        
        $keyword = trim($request->query('q', ''));

        if (strlen($keyword) < 2) {
            return response()->json([]);
        }

        $all     = $this->apiService->getGlosarium();
        $results = collect($all)
            ->filter(fn($item) =>
                str_contains(strtolower($item['istilah']),   strtolower($keyword)) ||
                str_contains(strtolower($item['deskripsi']), strtolower($keyword))
            )
            ->values()
            ->take(20); // batasi hasil search

        // dd($results);
        return response()->json($results);
    }
}
