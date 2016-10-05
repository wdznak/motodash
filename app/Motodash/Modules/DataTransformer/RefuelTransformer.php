<?php

namespace App\Motodash\Modules\DataTransformer;

use App\Models\Refuel;
use League\Fractal;

class RefuelTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param App\Models\Refuel $refuel
     * @return array
     */
    public function transform(Refuel $refuel)
    {
        return [
            'id' => (int) $refuel->id,
            'price' => (float) $refuel->price,
            'distance' => (float) $refuel->distance,
            'amount' => (float) $refuel->fuel_amount,
            'fuelType' => $refuel->fuelTypes->fuel_type,
            'petrolStation' => $refuel->petrolStationName->station_brand,
        ];
    }
}
