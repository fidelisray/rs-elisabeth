<?php

namespace App\Http\Resources\Api\Cms;

use Illuminate\Http\Request;

class PromotionResource extends BaseCmsResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'image_path'  => $this->image_path,
            'image_url'   => $this->generateImageUrl($this->image_path),
            'start_date'  => $this->start_date,
            'end_date'    => $this->end_date,
            'is_active'   => $this->is_active,
        ];
    }
}
