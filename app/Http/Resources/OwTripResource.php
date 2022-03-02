<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class OwTripResource extends Resource
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
            'id' => $this->id_event,
            'name' => $this->event->name,
            'url' => $this->event->reservation_url,
            'free' => $this->capacity - $this->howIsFill(),
            'capacity' => $this->capacity,
            'cover' => $this->event->cover_url,
            'full' => $this->isFull(),
            'dateInterval' => $this->dateInterval,
            'dayInterval' => $this->dayInterval,
        ];
    }
}
