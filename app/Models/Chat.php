<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_groups_id',
        'user_id',
        'message',
    ];


    public function user(){

        return $this->belongsTo(User::class);

    }
    public function Chat_group(){

        return $this->belongsTo(ChatGroups::class);

    }
}
