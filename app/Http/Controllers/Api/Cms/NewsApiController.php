<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Cms\NewsResource;
use App\Models\News;
use Illuminate\Support\Facades\Cache;

class NewsApiController extends Controller
{
    public function index()
    {
        $page = request('page', 1);
        $version = Cache::rememberForever('rs_web_cms_api_news_version', fn() => time());
        
        $news = Cache::remember("rs_web_cms_api_news_v{$version}_page_{$page}", now()->addHours(2), function () {
            return News::query()
                ->where('is_published', true)
                ->latest()
                ->paginate(12);
        });

        return NewsResource::collection($news);
    }

    public function show($slug)
    {
        $news = News::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return new NewsResource($news);
    }
}
