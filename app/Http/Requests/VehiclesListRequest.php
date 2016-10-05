<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class VehiclesListRequest extends Request
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
          'type' => "required|max:20",
          'brand' => "required|max:20",
          'model' => "required|max:20",
          'yearFrom' => "required|date_format:Y",
          'yearUntil' => "required|date_format:Y",
        ];
    }
}
