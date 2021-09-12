<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HouseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'          =>'required|string|max:40',
            'beds'           =>'required|numeric|integer',
            'baths'          =>'required|numeric|integer',
            'price'          =>'required|numeric',
            'place'          =>'required|string',
            'description'    =>'required|string',
            'property_type'  =>'required|string',
            'Balcony'        =>'nullable|string',
            'Parking'        =>'nullable|string',
            'Pool'           =>'nullable|string',
            'Beach'          =>'nullable|string',
            'Air_condtioning'=>'nullable|string',
            'Pet_friendly'   =>'nullable|string',
            'Kid_friendly'   =>'nullable|string',
            'src'            =>'required|image|max:2000',
        ];
    }
}
