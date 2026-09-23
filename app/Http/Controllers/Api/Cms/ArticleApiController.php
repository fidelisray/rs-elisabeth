<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Cms\ArticleResource;
use App\Models\Article;
use Illuminate\Support\Facades\Cache;
use OpenApi\Attributes as OA;

class ArticleApiController extends Controller
{
    #[OA\Get(
        path: "/api/v1/cms/articles",
        summary: "Get list of articles",
        security: [["HmacAuth" => []]],
        tags: ["Articles"],
        description: "Returns list of active articles with pagination."
    )]
    #[OA\Response(response: 200, description: "Successful operation")]
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

    #[OA\Get(
        path: "/api/v1/cms/articles/{id}",
        summary: "Get article detail",
        security: [["HmacAuth" => []]],
        tags: ["Articles"],
        description: "Returns a single article data."
    )]
    #[OA\Parameter(name: "id", description: "Article ID", in: "path", required: true)]
    #[OA\Response(response: 200, description: "Successful operation")]
    #[OA\Response(response: 404, description: "Resource Not Found")]
    public function show($id)
    {
        $article = Article::query()
            ->where('is_active', 'yes')
            ->findOrFail($id);

        return new ArticleResource($article);
    }
}
