<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ExchangeStudentResource extends Resource
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
            'id' => $this->hashId,
            'first_name' => $this->person->first_name,
            'last_name' => $this->person->last_name,
            'school' => $this->school,
            'accommodation' => $this->accommodation->full_name,
            'arrival' => $this->arrival == null ? null:  $this->arrival->arrivalFormatted,
            'country' => $this->country->full_name,
            'faculty' => $this->faculty->abbreviation,
        ];
    }
}
