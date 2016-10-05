<?php

namespace App\Motodash\Modules\DataTransformer;

use Auth;
use App\Models\UserVehicle;
use League\Fractal;

/**
 *
 */
class UserVehiclesTransformer extends Fractal\TransformerAbstract
{

    use ValidateIncludes;

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'modifications',
        'refuels',
        'galleries',
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param App\Models\UserVehicle $userVehicle
     * @return array
     */
    public function transform(UserVehicle $userVehicle)
    {
        return [
            'id' => (int) $userVehicle->id,
            'userId' => (int) $userVehicle->user_id,
            'type' => $userVehicle->vehicles->type,
            'brand' => $userVehicle->vehicles->brand,
            'model' => $userVehicle->vehicles->model,
            'version' => $userVehicle->version,
            'mileage' => (int) $userVehicle->mileage,
            'engine' => (int) $userVehicle->engine_size,
            'year' => (int) $userVehicle->production_date,
            'brand' => $userVehicle->vehicles->brand,
            'counters' => [
                'refuels' => (int) $userVehicle->refuels_count ?: 0,
                'modifications' => (int) $userVehicle->modifications_count ?: 0,
            ],
            'links' => [
                'vehicle' =>
                    route('user.uservehicle.show',
                    ['userId' =>
                        $userVehicle->user_id,
                        'vehicleId' => $userVehicle->id
                    ]),
                'thumbnail' => !$userVehicle->thumbnail ? url('/') . '/storage/gallery/default.png' :
                    url('/') . '/storage/gallery/' . $userVehicle->user_id . '/thumbnail-' . $userVehicle->thumbnail,
            ],
        ];
    }

    /**
     * Include Modifications
     *
     * @param App\Models\UserVehicle        $userVehicle
     * @return League\Fractal\ItemResource
     */
    public function includeModifications(UserVehicle $userVehicle)
    {
        return $this->collection(
            $userVehicle->modifications,
            new ModificationTransformer()
        );
    }

    /**
     * Include Refuels
     *
     * @param App\Models\UserVehicle        $userVehicle
     * @return League\Fractal\ItemResource
     */
    public function includeRefuels(UserVehicle $userVehicle)
    {
        $include = $this->findMatchingRelation($userVehicle, 'refuel');

        return $this->collection(
            $userVehicle[$include],
            new RefuelTransformer()
        );
    }

    /**
     * Include Galleries
     *
     * @param App\Models\UserVehicle        $userVehicle
     * @return League\Fractal\ItemResource
     */
    public function includeGalleries(UserVehicle $userVehicle)
    {
        return $this->collection(
            $userVehicle->galleries,
            new GalleryTransformer()
        );
    }
}
