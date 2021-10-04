<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
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
            'username'       =>$this->user->name,
            'message'       =>$this->message,
            'created_date'  =>\Carbon\Carbon::parse($this->created_at)->format('y, D, d M H:i'),
            'readed'  =>$this->read_at,
            // 'created_date'  =>$this->created_at,
            // 'created_date'  =>$this->created_at->format('d/m/Y'),
            // 'last_message'   =>$this->chats->last(),
        ];
    }
}
