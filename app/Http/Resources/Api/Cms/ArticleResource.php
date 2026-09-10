<?php

namespace App\Http\Resources\Api\Cms;

use Illuminate\Http\Request;

class ArticleResource extends BaseCmsResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'judul'         => $this->judul,
            'slug'          => $this->slug,
            'image_path'    => $this->image_path,
            'image_url'     => $this->generateImageUrl($this->image_path),
            'shorts'        => $this->shorts,
            'content'       => $this->content,
            'tags'          => $this->tags,
            'author'        => $this->author,
            'views'         => $this->views,
            'created_at'    => $this->created_at,
        ];
    }
}
