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
                'glossary' => $glossary,
                'activeLetter' => 'ALL',
                'availableLetters' => $availableLetters,
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

    public function tampil_data() {
        // 1. Ambil file JSON dari storage
        $jsonPath = storage_path('app/json/hasil_scraping2.json');
        
        if (!file_exists($jsonPath)) {
            abort(404, "File data tidak ditemukan.");
        }

        $jsonContent = file_get_contents($jsonPath);
        $rawData = json_decode($jsonContent, true);

        $glossaryData = [];

        // 2. Olah struktur data agar lebih mudah di-loop di Blade
        foreach ($rawData['data'] as $disease) {
            foreach ($disease as $slug => $details) {
                // Mengubah "atrial-fibrillation" menjadi "Atrial Fibrillation"
                $formattedTitle = ucwords(str_replace('-', ' ', $slug));

                $glossaryData[] = [
                    'slug' => $slug,
                    'title' => $formattedTitle,
                    'url' => $details['url'],
                    'sections' => $details['sections']
                ];
            }
        }

        // 3. Kirim data ke view
        return view('glosarium.gemini', compact('glossaryData'));
    }



    // Helper untuk membaca file JSON
    private function getJsonData()
    {
        $jsonPath = storage_path('app/json/hasil_scraping2.json');
        if (!file_exists($jsonPath)) {
            abort(404, "File data tidak ditemukan.");
        }
        return json_decode(file_get_contents($jsonPath), true)['data'];
    }

    // Menampilkan halaman A-Z dan daftar penyakit
    public function gemini_index(Request $request)
    {
        // Tangkap parameter '?letter=' dari URL. Jika kosong, default ke huruf 'A'
        $activeLetter = strtoupper($request->query('letter', 'A')); 
        
        $rawData = $this->getJsonData();
        $filteredDiseases = [];

        foreach ($rawData as $disease) {
            foreach ($disease as $slug => $details) {
                $title = ucwords(str_replace('-', ' ', $slug));
                
                // Filter: Hanya ambil penyakit yang huruf pertamanya cocok dengan parameter URL
                if (strtoupper(substr($title, 0, 1)) === $activeLetter) {
                    $filteredDiseases[] = [
                        'slug' => $slug,
                        'title' => $title
                    ];
                }
            }
        }

        // Urutkan alfabetis
        usort($filteredDiseases, function($a, $b) {
            return strcmp($a['title'], $b['title']);
        });

        $alphabets = range('A', 'Z');

        return view('glosarium.gemini', compact('filteredDiseases', 'alphabets', 'activeLetter'));
    }

    // Menampilkan halaman spesifik 1 penyakit
    public function gemini_show(string $slug)
    {
        $rawData = $this->getJsonData();
        $diseaseData = null;
        $title = ucwords(str_replace('-', ' ', $slug));

        // Cari penyakit yang slug-nya cocok dengan URL
        foreach ($rawData as $disease) {
            if (isset($disease[$slug])) {
                $diseaseData = $disease[$slug];
                break;
            }
        }

        if (!$diseaseData) {
            abort(404, "Penyakit tidak ditemukan.");
        }

        return view('glosarium.gemini-show', compact('diseaseData', 'title', 'slug'));
    }
}
