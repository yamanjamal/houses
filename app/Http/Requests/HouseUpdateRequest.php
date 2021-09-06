<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HouseUpdateRequest extends FormRequest
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
            'Balcony'        =>'required|boolean',
            'Parking'        =>'required|boolean',
            'Pool'           =>'required|boolean',
            'Beach'          =>'required|boolean',
            'Air_condtioning'=>'required|boolean',
            'Pet_friendly'   =>'required|boolean',
            'Kid_friendly'   =>'required|boolean',
            'src'            =>'required|image|max:2000',

        ];
    }
}
