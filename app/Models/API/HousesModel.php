<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousesModel extends Model
{
    use HasFactory;


    protected $fillable = [
        'img',
        'title',
        'place',
        'beds',
        'baths',
        'placedescription',
        'price',
        'square',
        'approved',
    ];
}
