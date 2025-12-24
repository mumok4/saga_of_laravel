<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'category' => $this->category ? $this->category->name : null,
            'tags' => $this->tags->pluck('name'),
            'comments_count' => $this->comments->count(),
            'created_at' => $this->created_at->toIso8601String(),
            'created_human' => $this->created_at->diffForHumans(),
        ];
    }
}