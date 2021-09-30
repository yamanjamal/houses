<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Traits\Multitenantable;

class ChatGroups extends Model
{
    use HasFactory;


     protected $fillable = [
        'src',
        'name',
        'user_id',
        'house_id',
        'owner_id',
    ];



    public function chats(){

        return $this->hasMany(Chat::class);

    }
    
    public function user(){

        return $this->belongsTo(User::class);

    }
}
