<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imge extends Model
{
    use HasFactory;

    protected $fillable = [
        'src',
        'house_id',
        'user_id',
    ];
    protected $visible = ['id','src'];


    public function house(){

        return $this->belongsTo(House::class);

    }
}
