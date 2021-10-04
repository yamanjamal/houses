<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ChatResource;

class ChatGroupsShowResource extends JsonResource
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
            'room_id'       =>$this->id,
            'chat_name'     =>$this->name,
            'chat_image'    =>$this->src,
            'messages'      =>ChatResource::collection($this->chats),
        ];
    }
}
