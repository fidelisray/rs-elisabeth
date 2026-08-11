<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'start_date',
        'end_date',
        'is_active',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::saved(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('local_cms_promotions_');
        });

        static::deleted(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('local_cms_promotions_');
        });
    }
}
