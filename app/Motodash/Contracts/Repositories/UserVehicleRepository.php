<?php

namespace App\Motodash\Contracts\Repositories;

use App\Models\User;

interface UserVehicleRepository
{
    /**
     * Get user vehicle with the most important information
     *
     * @param  int    $userVehicleId
     * @return string
     */
    public function vehicleMainInfo($userVehicleId);

    /**
     * Get all vehicles owned by user
     *
     * @param  App\Models\User $user
     * @return array
     */
    public function userVehicles(User $user);

    /**
     * Store new user vehicle in store
     *
     * @param  mixed           $requestData
     * @param  App\Models\User $user
     * @return array
     */
    public function newVehicle($request, User $user);
}
