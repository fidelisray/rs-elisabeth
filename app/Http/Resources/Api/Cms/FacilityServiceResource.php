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
            'icon_path'           => $this->icon_path,
            'icon_url'            => $this->generateImageUrl($this->icon_path),
            'highlights'          => $this->highlights,
            'wa_link_text'        => $this->wa_link_text,
            'wa_link_url'         => $this->wa_link_url,
            'has_appointment_cta' => $this->has_appointment_cta,
        ];
    }
}
