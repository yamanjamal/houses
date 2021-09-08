<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikesAndDislikes extends Model
{
    use HasFactory;


    protected $fillable = [
        'likeState',
        'user_id',
        'house_id',
    ];
    protected $visible = ['likeState','user_id','house_id'];

    public function user(){

        return $this->belongsTo(User::class);

    }
    public function house(){

        return $this->belongsTo(House::class);

    }
}
