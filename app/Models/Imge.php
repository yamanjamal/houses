<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Multitenantable;

class Imge extends Model
{
    use HasFactory,Multitenantable;

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
