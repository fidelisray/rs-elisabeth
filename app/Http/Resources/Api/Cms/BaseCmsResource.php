<?php

namespace App\Http\Resources\Api\Cms;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

abstract class BaseCmsResource extends JsonResource
{
    /**
     * Generate a full public URL from a storage path.
     * Returns null if path is empty or null.
     */
    protected function generateImageUrl(?string $path): ?string
    {
        return $path ? Storage::disk('public')->url($path) : null;
    }
}
