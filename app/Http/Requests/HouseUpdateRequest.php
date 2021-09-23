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
            'Balcony'        =>'boolean|nullable',
            'Parking'        =>'boolean|nullable',
            'Pool'           =>'boolean|nullable',
            'Beach'          =>'boolean|nullable',
            'Air_condtioning'=>'boolean|nullable',
            'Pet_friendly'   =>'boolean|nullable',
            'Kid_friendly'   =>'boolean|nullable',
            // 'src'            =>'required|string',
        ];
    }
}
