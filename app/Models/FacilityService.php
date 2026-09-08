<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class FacilityService extends Model
{
    use \App\Traits\ConvertsImagesToWebp;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'icon_path',
        'category',
        'highlights',
        'wa_link_text',
        'wa_link_url',
        'has_appointment_cta',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'highlights'          => 'array',
        'has_appointment_cta' => 'boolean',
        'sort_order'          => 'integer',
        'is_active'           => 'boolean',
    ];

    /**
     * Boot: auto-generate slug, dan invalidasi cache setiap ada perubahan data.
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

        // Flush cache lokal agar perubahan dari CMS langsung terekspos ke frontend.
        static::saved(function () {
            Cache::forget('local_cms_facility_services_');
        });

        static::deleted(function () {
            Cache::forget('local_cms_facility_services_');
        });
    }

    public function getWebpFields(): array
    {
        return ['icon_path'];
    }
}
