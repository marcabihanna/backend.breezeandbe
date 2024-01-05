<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductTitleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'title' => $this->title,
            'home_image' => ($this->home_image)??null, // Assuming 'home_image' is a path or URL
            'price' => $this->price,
            'gallery_image' => $this->gallery_image,
            'preview_image' =>($this->preview_image) ? $this->preview_image:null,



        ];
    }
}
