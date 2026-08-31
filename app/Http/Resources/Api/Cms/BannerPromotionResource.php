<?php

namespace App\Http\Resources\Api\Cms;

use Illuminate\Http\Request;

class BannerPromotionResource extends BaseCmsResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'title'      => $this->title,
            'image_path' => $this->image_path,
            'image_url'  => $this->generateImageUrl($this->image_path),
            'sort_order' => $this->sort_order,
            'is_active'  => $this->is_active,
        ];
    }
}
