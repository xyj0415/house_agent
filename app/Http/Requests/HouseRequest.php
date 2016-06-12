<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class HouseRequest extends Request
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
            'name'          => 'required',
            'city'          => 'required',
            'district'      => 'required',
            'address'       => 'required',
            'price'         => 'required|integer',
            'area'          => 'required|integer',
            'buildyear'     => 'required|integer',
            'description'   => 'required',
        ];
    }
}
