<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TripAuthUserResource extends JsonResource
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
            'medical_issues' => $this->person->medical_issues,
            'diet' => $this->person->diet
        ];
    }
}
