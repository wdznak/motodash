<?php

namespace App\Motodash\Modules\DataTransformer;

use App\Models\User;
use League\Fractal;

class UserTransformer extends Fractal\TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'vehicles',
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param App\Models\User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => (int) $user->id,
            'nick' => $user->name,
            'name' => $user->first_name,
            'surname' => $user->surname,
            'age' => (int) $user->age,
            'email' => $user->email,
            'links' => [
                'avatar' => $user->avatar,
            ],
        ];
    }

    /**
     * Include User
     *
     * @param App\Models\User $user
     * @return League\Fractal\ItemResource
     */
    public function includeVehicles(User $user)
    {
        return $this
              ->collection($user->userVehicles, new UserVehiclesTransformer());
    }
}
