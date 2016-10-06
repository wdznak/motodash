<?php

namespace App\Motodash\Users\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserVehicleRequest;
use App\Models\User;
use App\Models\UserVehicle;
use App\Motodash\Contracts\Repositories\UserVehicleRepository;
use App\Motodash\Facades\GraphicTransformer;

class UserVehicleController extends Controller
{
    /**
     * UserVehicleRepository instance
     *
     * @var $userVehicleRepository
     */
    protected $userVehicleRepository;

    /**
     * @param App\Motodash\Contracts\Repositories\UserVehicleRepository $userVehicleRepository
     */
    public function __construct(UserVehicleRepository $userVehicleRepository)
    {
        $this->userVehicleRepository = $userVehicleRepository;
    }

    /**
     * Show list of all user vehicles
     *
     * @param  Illuminate\Http\Request   $request
     * @param  App\Models\User           $user
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        return response()->json(
            json_encode($this->userVehicleRepository->userVehicles($user))
        );
    }

    /**
     * Returns view with specified user vehicle
     *
     * @param  int   $userId
     * @param  int   $userVehicleId
     * @return view
     */
    public function show($userId, $userVehicleId)
    {
        $vehicleDetails = $this->userVehicleRepository
                               ->vehicleMainInfo($userVehicleId);

        return view('layouts.user.user_vehicle', ['vehicleDetails' => $vehicleDetails]);
    }

    /**
     * Store new user vehicle
     *
     * @param  App\Http\Requests\CreateUserVehicleRequest $request
     * @param  App\Models\User                            $user
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserVehicleRequest $request, User $user)
    {
        $newVehicle = $this->userVehicleRepository
                           ->newVehicle($request, $user);

        return response()->json(
            json_encode([
                'message' => 'Success',
                'vehicle' => $newVehicle
            ]),
            201
        );
    }

    /**
     * Update user vehicle
     *
     * @param  App\Http\Requests\CreateUserVehicleRequest $request
     * @param  int                                        $userVehicleId
     * @return \Illuminate\Http\Response
     */
    public function update(CreateUserVehicleRequest $request, $userVehicleId)
    {
        $this->userVehicleRepository->updateVehicle($request, $userVehicleId);

        return response()->json(
            json_encode([
                'message' => 'Your vehicle has been updated.'
            ]),
            200
        );
    }

    /**
     * Remove the specified user vehicle from storage.
     *
     * @param App\Models\User        $user
     * @param App\Models\UserVehicle $userVehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, UserVehicle $uservehicle)
    {
        if(\Gate::denies('modify-userVehicle', $uservehicle)) {
            abort(403);
        }

        $uservehicle->deleteVehicle();

        return redirect()->route('user.show', ['userId' => $user->id]);
    }
}
