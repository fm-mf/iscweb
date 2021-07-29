<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class BuddyResource extends Resource
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
            'id_user' => $this->id_user,
            'first_name' => $this->person->first_name,
            'last_name' => $this->person->last_name,
            'partak' => $this->user->isPartak(),
            'exchange_students_count' => $this->exchange_students_count
        ];
    }
}
