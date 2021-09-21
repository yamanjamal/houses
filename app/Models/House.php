<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Multitenantable;

class House extends Model
{
    use HasFactory,Multitenantable;

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
    public function LikesAndDislikes(){

        return $this->hasMany(LikesAndDislikes::class);
        
    }

    public function getPropertyTypeAttribute($value){
        // ['house','vella','appartment']
        if($value=='0'){
            return 'house';
        }elseif ($value=='1') {
            return 'vella';
        }elseif($value=='2'){
            return 'appartment';
        }
    }
    public function getapprovedAttribute($value){
        // ['approver','inprogress','declined']
        if($value=='0'){
            return 'approver';
        }elseif ($value=='1') {
            return 'inprogress';
        }elseif($value=='2'){
            return 'declined';
        }
    }
}


