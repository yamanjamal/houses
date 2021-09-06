<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'beds',
        'baths',
        'price',
        'place',
        'description',
        'property_type',
        'Balcony',
        'Parking',
        'Pool',
        'Beach',
        'Air_condtioning',
        'Pet_friendly',
        'Kid_friendly',
        'approved',
        'rating',
        'user_id',
    ];

    public function user(){

        return $this->belongsTo(User::class);

    }
    public function imeges(){

        return $this->hasMany(Imge::class);
        
    }
    public function comments(){

        return $this->hasMany(Comment::class);
        
    }
}


