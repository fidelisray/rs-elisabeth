<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DoctorApiService;
use App\Services\HospitalApiService;
use App\Traits\FormatsArticleData;

class HomeController extends Controller
{
    use FormatsArticleData;

    public function __construct(
        protected DoctorApiService $doctorApiService,
        protected HospitalApiService $hospitalApiService
    ) {}

    public function index()
    {
        // 1. Ambil data spesialisasi dokter
        $spesialisasi = $this->doctorApiService->getDaftarSpesialisasi();

        // 2. Ambil data Artikel Kesehatan
        $rawArticles = $this->hospitalApiService->getArticles();
        $latestArticles = $this->formatApiData($rawArticles)->take(7)->toArray();

        // 3. Ambil data Berita (ElisaNews)
        $rawNews = $this->hospitalApiService->getNews();
        $latestNews = $this->formatApiData($rawNews)->take(7)->toArray();

        return view('home.index', compact('spesialisasi', 'latestArticles', 'latestNews'));
    }
}
