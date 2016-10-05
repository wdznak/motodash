<?php

namespace App\Motodash\Contracts\Repositories;

use App\Models\User;

interface UserRepository
{
    /**
     * Get all user vehicles
     *
     * @param  App\Models\User $user
     * @return string
     */
    public function allVehicles(User $user);
}
