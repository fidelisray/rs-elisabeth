<?php

namespace App\Http\Resources\Api\Cms;

use Illuminate\Http\Request;

class FacilityServiceResource extends BaseCmsResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'icon_path'   => $this->icon_path,
            'icon_url'    => $this->generateImageUrl($this->icon_path),
            'category'    => $this->category,
        ];
    }
}
