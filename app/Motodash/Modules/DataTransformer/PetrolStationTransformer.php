<?php

namespace App\Motodash\Modules\DataTransformer;

use App\Models\PetrolStation;
use League\Fractal;

class PetrolStationTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param App\Models\Refuel $refuel
     * @return array
     */
    public function transform(PetrolStation $petrolStation)
    {
        return [
            'id' => (int) $petrolStation->id,
            'petrolStation' => $petrolStation->station_brand,
        ];
    }
}
