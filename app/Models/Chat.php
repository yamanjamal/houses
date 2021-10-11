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
        'read_at',
    ];

    protected $visible = ['id','user_id','message','created_at','read_at'];

    public function user(){

        return $this->belongsTo(User::class);

    }
    public function Chat_group(){

        return $this->belongsTo(ChatGroups::class);

    }
}
