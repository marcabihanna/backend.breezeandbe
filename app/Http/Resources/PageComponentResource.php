<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageComponentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'page' => $this->page,
            'slug' => $this->slug,
            'title' => $this->title_description,
            'description' => $this->description,
            'description2'=>$this->description2,
            'image' => $this->image,
            'video' => $this->video,
            'button_text' => $this->button_text,
            'button_url' => $this->button_url,
        ];
    }
}
