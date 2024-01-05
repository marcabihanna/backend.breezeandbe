<?php

namespace App\Http\Resources;

use App\Models\ContactDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FooterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $contact=ContactDetail::first();
        return [
            'email' => $contact->email,
            'phone' => $contact->phone,
            'phone2' => $contact->phone2,
            'image1' => ($this->image1)?$this->image1:null,
            'image2' => ($this->image2)?$this->image2:null,
            'image3' => ($this->image3)?$this->image3:null,
            'image4' => ($this->image4)?$this->image4:null,
        ];
    }
}
