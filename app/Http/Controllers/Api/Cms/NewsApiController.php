<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsApiController extends Controller
{
    public function index()
    {
        $news = \App\Models\News::where('is_published', true)->latest()->get();
        $news->transform(function ($item) {
            if ($item->image_path) {
                $item->image_url = url(\Illuminate\Support\Facades\Storage::url($item->image_path));
            }
            return $item;
        });
        return response()->json($news);
    }

    public function show($slug)
    {
        $news = \App\Models\News::where('slug', $slug)->where('is_published', true)->firstOrFail();
        if ($news->image_path) {
            $news->image_url = url(\Illuminate\Support\Facades\Storage::url($news->image_path));
        }
        return response()->json($news);
    }
}
