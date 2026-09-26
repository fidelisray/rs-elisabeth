<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\HospitalApiService;

class NewsController extends Controller
{
    use \App\Traits\FormatsArticleData;

    public function index(HospitalApiService $apiService)
    {
        $rawNews = $apiService->getNews();
        $newsList = $this->formatApiData($rawNews)->all();

        return view('news.index', compact('newsList'));
    }

    public function show($slug, HospitalApiService $apiService)
    {
        $rawNews = $apiService->getNews();
        $newsList = $this->formatApiData($rawNews);
        
        $news = $newsList->firstWhere('slug', $slug);

        if (!$news) {
            abort(404);
        }

        return view('news.show', compact('news'));
    }
}
