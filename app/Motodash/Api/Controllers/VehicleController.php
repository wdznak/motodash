<?php

namespace App\Motodash\Api\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VehiclesListRequest as ValidateRequest;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Motodash\Contracts\Modules\DataTransformer;

class VehicleController extends Controller
{

    protected $vehicle;

    public function __construct(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;
    }

    /**
     * Vehicles administration panel
     *
     * @param  App\Http\Requests                              $request
     * @param  App\Motodash\Contracts\Modules\DataTransformer $transform
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, DataTransformer $transform)
    {
        return response()->json(
            $transform->transformVehicleForAjax($this->vehicle->all()->toArray())
        );
    }
}
