<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class CommntResource extends JsonResource
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
            // 'id'=>$this->id,
            'username'=>$this->user->name,
            'content'=>$this->content,
            'user_id'=>$this->user->id,
            // 'house_id'=>$this->house->id,
            // 'username'=>$username->name,
        ];
    }
}
