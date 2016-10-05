<?php

namespace App\Policies;

use App\Models\UserVehicle;

class UserPolicy
{

    public function modifyUser($user, $requestUser)
    {
        if(! $requestUser instanceof User) {
            $requestUser = User::findOrFail($requestUser);
        }

        return $user->id == $requestUser->user_id;
    }

    public function modifyVehicle($user, $uservehicle)
    {
        if(! $uservehicle instanceof UserVehicle) {
            $uservehicle = UserVehicle::findOrFail($uservehicle);
        }

        return $user->id == $uservehicle->user_id;
    }
}
