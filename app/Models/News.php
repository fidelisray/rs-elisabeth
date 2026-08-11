<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image_path',
        'is_published',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::saved(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('local_cms_news_');
        });

        static::deleted(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('local_cms_news_');
        });
    }
}
