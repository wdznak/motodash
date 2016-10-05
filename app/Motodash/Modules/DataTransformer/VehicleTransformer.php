<?php

namespace App\Motodash\Modules\DataTransformer;

use App\Models\Vehicle;
use League\Fractal;
use Illuminate\Support\Collection;

class VehicleTransformer extends Fractal\TransformerAbstract
{

    /**
     * Turn this item object into a generic array
     *
     * @param App\Models\Vehicle $vehicle
     * @return array
     */
    public function transform(Vehicle $vehicle)
    {
        return [
                'type' => $vehicle->type,
                'brand' => $vehicle->brand,
                'model' => $vehicle->model,
                'produced' => $vehicle->produced_from . '-' . $vehicle->produced_to
            ];
    }
}
