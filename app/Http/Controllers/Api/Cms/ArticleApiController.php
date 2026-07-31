<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleApiController extends Controller
{
    public function index()
    {
        $articles = \App\Models\Article::latest()->get();
        $articles->transform(function ($item) {
            if ($item->image_path) {
                $item->image_url = url(\Illuminate\Support\Facades\Storage::url($item->image_path));
            }
            return $item;
        });
        return response()->json($articles);
    }

    public function show($slug)
    {
        $article = \App\Models\Article::where('slug', $slug)->firstOrFail();
        if ($article->image_path) {
            $article->image_url = url(\Illuminate\Support\Facades\Storage::url($article->image_path));
        }
        return response()->json($article);
    }
}
