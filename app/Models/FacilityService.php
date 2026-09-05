<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    ];

    protected $casts = [
        'highlights' => 'array',
        'has_appointment_cta' => 'boolean',
    ];

    public function getWebpFields(): array
    {
        return ['icon_path'];
    }
}
