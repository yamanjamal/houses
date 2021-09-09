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
            'commentid'=>$this->id,
            'username'=>$this->user->name,
            'user_id'=>$this->user->id,
            'content'=>$this->content,
            // 'house_id'=>$this->house->id,
            // 'username'=>$username->name,
        ];
    }
}
