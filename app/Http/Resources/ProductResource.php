<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'home_description' => $this->home_description,
            'home_image' => ($this->home_image)??null, // Assuming 'home_image' is a path or URL
            'gallery_image' => $this->gallery_image,
            'benefits' => $this->benefits,
            'description' => $this->description,
            'size' => $this->size,
            'key_featured' => $this->key_featured,
            'featured_ingredients' => $this->featured_ingredients,
            'price' => $this->price,
            'preview_image' =>($this->preview_image) ? $this->preview_image:null,
            'status' => (bool)$this->status,


        ];
    }
}
