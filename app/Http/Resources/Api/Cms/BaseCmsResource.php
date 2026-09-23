<?php

namespace App\Http\Resources\Api\Cms;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

abstract class BaseCmsResource extends JsonResource
{
    /**
     * Generate a full public URL from a storage path.
     * Returns null if path is empty or null.
     */
    protected function generateImageUrl(?string $path): ?string
    {
        return $path ? Storage::disk(config('filesystems.default', 's3'))->url($path) : null;
    }

    /**
     * Get additional data that should be returned with the resource array.
     */
    public function with(Request $request): array
    {
        return [
            'success'     => true,
            'status_code' => 200,
            'message'     => 'Data retrieved successfully.',
        ];
    }
}
