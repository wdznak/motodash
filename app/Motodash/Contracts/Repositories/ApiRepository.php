<?php

namespace App\Motodash\Contracts\Repositories;

interface ApiRepository
{
    /**
     * Get full list of the petrol stations
     *
     * @return array
     */
    public function petrolStationList();

    /**
     * Get full list of the fuel types
     *
     * @return array
     */
    public function fuelTypeList();

    /**
     * Get full list of the petrol stations and fuel types
     *
     * @return array
     */
    public function petrolStationWithFuelTypes();
}
