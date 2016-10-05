<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateUserVehicleRequest extends Request
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
     * Validation rules for store user vehicle request
     *
     * @return array
     */
    public function rules()
    {
        return [
          'vehicle_id' => "required|exists:vehicles,id",
          'version' => "string|max:20",
          'cover-photo' => "mimes:jpeg,bmp,png|dimensions:max_height=1080,max_width=1920",
          'mileage' => "numeric|digits_between:1,7",
          'engine_size' => "numeric|digits_between:1,5",
        ];
    }
}
