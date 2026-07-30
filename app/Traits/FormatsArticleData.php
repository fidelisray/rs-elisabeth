<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait FormatsArticleData
{
    /**
     * Format raw API data for articles/news into a standardized collection.
     * Extracts images from HTML, creates slugs, and standardizes fields.
     */
    protected function formatApiData(array $apiData): \Illuminate\Support\Collection
    {
        return collect($apiData)->map(function($item) {
            // Extract the first image source from the HTML description (if available)
            preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $item['deskripsi'] ?? '', $image);
            $thumbnail = $image['src'] ?? asset('images/hero.jpg');
            
            return [
                'id' => $item['id'] ?? 0,
                'title' => $item['judul'] ?? 'Tanpa Judul',
                'slug' => Str::slug($item['judul'] ?? 'item-' . ($item['id'] ?? rand())),
                'image' => $thumbnail,
                'date' => $item['created_at'] ?? now()->toDateString(),
                'excerpt' => $item['subjudul'] ?? '',
                'content' => $item['deskripsi'] ?? '',
            ];
        });
    }
}
