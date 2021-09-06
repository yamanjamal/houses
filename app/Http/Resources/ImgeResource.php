<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImgeResource extends JsonResource
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
            'id'      =>$this->id,
            'src'     =>$this->src,
            'house_id'=>$this->house->id,
            // 'house_id'   =>DeleteHouseResource::$this->house,

        ];
    }
}
