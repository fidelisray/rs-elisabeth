<?php

namespace App\Http\Resources\Api\Cms;

use Illuminate\Http\Request;

class NewsResource extends BaseCmsResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'title'        => $this->title,
            'slug'         => $this->slug,
            'content'      => $this->content,
            'image_path'   => $this->image_path,
            'image_url'    => $this->generateImageUrl($this->image_path),
            'is_published' => $this->is_published,
            'created_at'   => $this->created_at,
        ];
    }
}
