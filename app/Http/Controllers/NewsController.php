<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\HospitalApiService;

class NewsController extends Controller
{
    /**
     * Dummy data for news articles.
     * Later this will be replaced by API calls.
     */
    private function formatApiNews($apiData)
    {
        return collect($apiData)->map(function($item) {
            preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $item['deskripsi'] ?? '', $image);
            $thumbnail = $image['src'] ?? asset('images/hero.jpg');
            
            return [
                'id' => $item['id'] ?? 0,
                'title' => $item['judul'] ?? 'Tanpa Judul',
                'slug' => Str::slug($item['judul'] ?? 'berita-' . ($item['id'] ?? rand())),
                'image' => $thumbnail,
                'date' => $item['created_at'] ?? now()->toDateString(),
                'excerpt' => $item['subjudul'] ?? '',
                'content' => $item['deskripsi'] ?? '',
            ];
        });
    }

    public function show($slug, HospitalApiService $apiService)
    {
        $articles = $apiService->getArticles('artikel');
        $newsList = $this->formatApiNews($articles);
        
        $news = $newsList->firstWhere('slug', $slug);

        if (!$news) {
            abort(404);
        }

        return view('news.show', compact('news'));
    }

    public function getArticles(Request $request, HospitalApiService $apiService)
    {
        $kategori = $request->query('category', 'artikel');
        $articles = $apiService->getArticles($kategori);
        
        $newsList = $this->formatApiNews($articles)->all();

        return view('news.index', compact('newsList'));
    }
}
