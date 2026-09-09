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
            'id'                  => $this->id,
            'name'                => $this->name,
            'slug'                => $this->slug,
            'category'            => $this->category,
            'description'         => $this->description,
            'short_description'   => $this->short_description,
            'image_path'          => $this->image_path,
            'image_url'           => $this->generateImageUrl($this->image_path),
            'highlights'          => $this->highlights,
            'wa_link_text'        => $this->wa_link_text,
            'wa_link_url'         => $this->wa_link_url,
            'has_appointment_cta' => $this->has_appointment_cta,
        ];
    }
}
