<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleApiController extends Controller
{
    public function index()
    {
        $articles = \App\Models\Article::where('is_active', 'yes')->latest()->get();
        $articles->transform(function ($item) {
            if ($item->thumbnail) {
                // KODE LAMA (Menggunakan disk default 'local' / private)
                // Jangan dihapus, uncomment jika ingin kembali ke konfigurasi bawaan
                // $item->thumbnail_url = url(\Illuminate\Support\Facades\Storage::url($item->thumbnail));

                // Gunakan disk public untuk men-generate URL karena file disimpan di public disk
                $item->thumbnail_url = \Illuminate\Support\Facades\Storage::disk('public')->url($item->thumbnail);
            }
            return $item;
        });
        return response()->json($articles);
    }

    public function show($id)
    {
        $article = \App\Models\Article::where('is_active', 'yes')->findOrFail($id);
        if ($article->thumbnail) {
            // KODE LAMA (Menggunakan disk default 'local' / private)
            // Jangan dihapus, uncomment jika ingin kembali ke konfigurasi bawaan
            // $article->thumbnail_url = url(\Illuminate\Support\Facades\Storage::url($article->thumbnail));

            // Gunakan disk public
            $article->thumbnail_url = \Illuminate\Support\Facades\Storage::disk('public')->url($article->thumbnail);
        }
        return response()->json($article);
    }
}
