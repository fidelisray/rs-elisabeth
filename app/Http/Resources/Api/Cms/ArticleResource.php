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
            'thumbnail'     => $this->thumbnail,
            'thumbnail_url' => $this->generateImageUrl($this->thumbnail),
            'shorts'        => $this->shorts,
            'isi'           => $this->isi,
            'tags'          => $this->tags,
            'author'        => $this->author,
            'views'         => $this->views,
            'created_at'    => $this->created_at,
        ];
    }
}
