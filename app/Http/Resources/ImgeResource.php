<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\HouseResource;

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
            'img_id'  =>$this->id,
            'src'     =>$this->src,
            'house_id'=>$this->house->id,
        ];
    }
}
