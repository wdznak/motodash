<?php

namespace App\Motodash\Modules\DataTransformer;

use App\Models\FuelType;
use League\Fractal;

class FuelTypeTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param App\Models\FuelType $fuelType
     * @return array
     */
    public function transform(FuelType $fuelType)
    {
        return [
            'id' => (int) $fuelType->id,
            'fuelType' => $fuelType->fuel_type,
        ];
    }
}
