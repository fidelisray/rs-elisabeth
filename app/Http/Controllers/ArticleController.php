<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HospitalApiService;

class ArticleController extends Controller
{
    use \App\Traits\FormatsArticleData;

    public function index(HospitalApiService $apiService)
    {
        $rawArticles = $apiService->getArticles();
        $articlesList = $this->formatApiData($rawArticles)->all();

        return view('articles.index', compact('articlesList'));
    }

    public function show($slug, HospitalApiService $apiService)
    {
        $rawArticles = $apiService->getArticles();
        $articlesList = $this->formatApiData($rawArticles);
        
        $article = $articlesList->firstWhere('slug', $slug);

        if (!$article) {
            abort(404);
        }

        return view('articles.show', compact('article'));
    }
}
