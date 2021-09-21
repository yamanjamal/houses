<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class HouseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'ownerid'           => $this->user->id,
            'ownername'         => $this->user->name,
            'houseid'           => $this->id,
            'title'             => $this->title,
            'beds'              => $this->beds,
            'baths'             => $this->baths,
            'price'             => $this->price,
            'place'             => $this->place,
            'description'       => $this->description,
            'property_type'     => $this->property_type,    
            'rating'            => $this->rating,
            'imeges'            => $this->imeges->first(),
            // 'firstpage'         => $this->from,
            // 'last_page'         => $this->last_page,

        ];
    }
}
