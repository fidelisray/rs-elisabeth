<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Cms\ArticleResource;
use App\Models\Article;

class ArticleApiController extends Controller
{
    public function index()
    {
        $articles = Article::query()
            ->where('is_active', 'yes')
            ->latest()
            ->get();

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
