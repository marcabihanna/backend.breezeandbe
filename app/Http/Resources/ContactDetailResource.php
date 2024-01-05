<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'email' => $this->email,
            'phone' => $this->phone,
            'phone2' => $this->phone2,
            'facebook' => $this->facebook,
            'you_tube' => $this->you_tube,
            'instagram' => $this->instagram,
            'tik_tok' => $this->tik_tok,
            'linked_in' => $this->linked_in,
        ];
    }
}
