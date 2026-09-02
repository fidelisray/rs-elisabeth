<?php

namespace App\Models;

use App\Traits\ConvertsImagesToWebp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RoomFacility extends Model
{
    use ConvertsImagesToWebp;

    /**
     * Kolom-kolom yang menyimpan path gambar dan akan dikonversi ke WebP.
     */
    protected function getWebpFields(): array
    {
        return ['image_path'];
    }

    protected $fillable = [
        'name',
        'slug',
        'category',
        'tagline',
        'description',
        'room_size',
        'bed_count',
        'max_companion',
        'image_path',
        'amenities',
        'highlight_tags',
        'whatsapp_text',
        'sort_order',
        'is_active',
    ];

    /**
     * Cast JSON columns to array and boolean column to bool.
     */
    protected $casts = [
        'amenities'      => 'array',
        'highlight_tags' => 'array',
        'is_active'      => 'boolean',
        'sort_order'     => 'integer',
    ];

    /**
     * Auto-generate slug from name on creating, if slug is empty.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (self $model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });

        static::updating(function (self $model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });

        static::saved(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('local_cms_room_facilities_');
        });

        static::deleted(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('local_cms_room_facilities_');
        });
    }
}
