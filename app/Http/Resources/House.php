<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CommntResource;
use App\Models\LikesAndDislikes;

class House extends JsonResource
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
            'Balcony'           => $this->Balcony,
            'Parking'           => $this->Parking,
            'Pool'              => $this->Pool,
            'Beach'             => $this->Beach,
            'Air_condtioning'   => $this->Air_condtioning,
            'Pet_friendly'      => $this->Pet_friendly,
            'Kid_friendly'      => $this->Kid_friendly,
            'Pet_friendly'      => $this->Pet_friendly,
            'rating'            => $this->rating,
            'likes'=>count(LikesAndDislikes::where('house_id',$this->id)->where('likeState',1)->get()),
            'dislikes'=>count(LikesAndDislikes::where('house_id',$this->id)->where('likeState',0)->get()),
            'imeges'               =>ImgeResource::collection( $this->imeges),
            'comments'          => CommntResource::collection( $this->comments),
            // 'imeges'            => $this->imeges,
        ];
    }
}
