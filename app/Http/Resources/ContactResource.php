<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Propaganistas\LaravelPhone\PhoneNumber;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'position' => $this->position,
            'email' => $this->email,
            'name' => $this->name,
            'phone' => $this->phone,
            'phoneWithSpaces' => $this->when($this->phone != null, $this->phoneWithSpaces),
            'phoneWithNBSpaces' => $this->when($this->phone != null, $this->phoneWithNBSpaces),
            'photo' => $this->photoFilePath,
            'visible' => $this->visible,
            'phone_visible' => $this->phone_visible,
        ];
    }
}
