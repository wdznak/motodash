<?php

namespace App\Motodash\Repositories;

use App\Motodash\Contracts\Repositories\ApiRepository;
use App\Motodash\Contracts\Modules\DataTransformer;
use App\Models\PetrolStation;
use App\Models\FuelType;
use App\Motodash\Modules\DataTransformer\PetrolStationTransformer;
use App\Motodash\Modules\DataTransformer\FuelTypeTransformer;

class EloquentApiRepository implements ApiRepository
{
    /**
     * Instance of DataTransform
     *
     * @var App\Motodash\Contracts\Modules\DataTransformer $transform
     */
    protected $transform;

    /**
     * @param App\Motodash\Contracts\Modules\DataTransformer $transform
     */
    function __construct(DataTransformer $transform){
        $this->transform = $transform;
    }

    /**
     * Get full list of the petrol stations
     *
     * @return array
     */
    public function petrolStationList()
    {
        return $this->transform
                    ->transformCollection(
                        PetrolStation::name()->get(),
                        PetrolStationTransformer::class
                    );
    }

    /**
     * Get full list of the fuel types
     *
     * @return array
     */
    public function fuelTypeList()
    {
        return $this->transform
                    ->transformCollection(
                        FuelType::name()->get(),
                        FuelTypeTransformer::class
                    );
    }

    /**
     * Get full list of the petrol stations and fuel types
     *
     * @return array
     */
    public function petrolStationWithFuelTypes()
    {
        $petrolStations = $this->petrolStationList();
        $fuelTypes = $this->fuelTypeList();

        return compact('petrolStations', 'fuelTypes');
    }

}
