<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;


    protected $fillable = [
        'content',
        'user_id',
        'house_id',
    ];
    protected $visible = ['content','user_id'];

    public function user(){

        return $this->belongsTo(User::class);

    }
    public function house(){

        return $this->belongsTo(House::class);

    }
}
