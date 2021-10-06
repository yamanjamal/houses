<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Chat;

class Message implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // public $username;
    public $chat;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Chat $chat)
    {
        // $this->username=$username;
        $this->chat=$chat;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat.'.$this->chat->chat_groups_id);
    }

    // public function broadcastAs()
    // {
    //     return 'message';
    // }
}
