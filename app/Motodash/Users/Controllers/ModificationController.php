<?php

namespace App\Motodash\Users\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserVehicle;

class ModificationController extends Controller
{
    /**
     * Store new refuel
     *
     * @param  Illuminate\Http\Request   $request
     * @param  App\Models\UserVehicle    $userVehicle
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, UserVehicle $uservehicle)
    {
        if(\Gate::denies('modify-userVehicle', $uservehicle)) {
            abort(403);
        }

        $uservehicle->modifications()
                    ->create($request->all());

        return response()->json(['message' => 'success']);
    }
}
