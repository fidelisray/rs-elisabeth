<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Cms\NewsResource;
use App\Models\News;

class NewsApiController extends Controller
{
    public function index()
    {
        $news = News::query()
            ->where('is_published', true)
            ->latest()
            ->get();

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
