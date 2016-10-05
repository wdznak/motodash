<?php

namespace App\Motodash\Repositories;

use App\Motodash\Contracts\Repositories\UserRepository;
use App\Motodash\Contracts\Modules\DataTransformer;
use App\Motodash\Modules\DataTransformer\UserVehiclesTransformer;
use App\Models\User;

class EloquentUserRepository implements UserRepository
{
    /**
     * Instance of DataTransformer
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
     * Get all user vehicles
     *
     * @param  App\Models\User $user
     * @return string
     */
    public function allVehicles(User $user)
    {
        return $this->transform
                    ->transformCollection(
                        $user->userVehicles()->get(),
                        UserVehiclesTransformer::class
                    );
    }
}
