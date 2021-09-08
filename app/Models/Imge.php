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
    ];
    protected $visible = ['src'];


    public function house(){

        return $this->belongsTo(House::class);

    }
}
