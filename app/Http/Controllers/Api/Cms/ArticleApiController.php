<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Cms\ArticleResource;
use App\Models\Article;
use Illuminate\Support\Facades\Cache;

class ArticleApiController extends Controller
{
    public function index()
    {
        $page = request('page', 1);
        $version = Cache::rememberForever('rs_web_cms_api_articles_version', fn() => time());
        
        $articles = Cache::remember("rs_web_cms_api_articles_v{$version}_page_{$page}", now()->addHours(2), function () {
            return Article::query()
                ->where('is_active', 'yes')
                ->latest()
                ->paginate(12);
        });

        return ArticleResource::collection($articles);
    }

    public function show($id)
    {
        $article = Article::query()
            ->where('is_active', 'yes')
            ->findOrFail($id);

        return new ArticleResource($article);
    }
}
