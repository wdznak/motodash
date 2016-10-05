<?php

namespace App\Motodash\Api\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Motodash\Contracts\Repositories\ApiRepository;

class PetrolStationController extends Controller
{
    protected $apiRepository;

    public function __construct(ApiRepository $apiRepository)
    {
        $this->apiRepository = $apiRepository;
    }

    /**
     * Get list of the petrol stations with optional fuel type list
     * @param  Request                   $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('fuelType')) {
            return response()->json(
                json_encode($this->apiRepository
                     ->petrolStationWithFuelTypes())
            );
        }

        return response()->json(
            json_encode($this->apiRepository
                 ->petrolStationList())
        );
    }
}
