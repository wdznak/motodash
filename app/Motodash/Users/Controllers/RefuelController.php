<?php

namespace App\Motodash\Users\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserVehicle;

class RefuelController extends Controller
{
    /**
     * Store new refuel
     *
     * @param  Request                   $request
     * @param  App\Models\UserVehicle    $userVehicle
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, UserVehicle $uservehicle)
    {
        if(\Gate::denies('modify-userVehicle', $uservehicle)) {
            abort(403);
        }

        $uservehicle->refuels()
                    ->create($request->all());

        return response()->json(['message' => 'success']);
    }
}
