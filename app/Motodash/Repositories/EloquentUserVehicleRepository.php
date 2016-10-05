<?php

namespace App\Motodash\Repositories;

use Auth;
use Config;
use Storage;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserVehicle;
use App\Motodash\Contracts\Repositories\UserVehicleRepository as UserVehicleInterface;
use App\Motodash\Contracts\Modules\DataTransformer;
use App\Motodash\Facades\GraphicTransformer;
use App\Motodash\Modules\DataTransformer\UserVehiclesTransformer;

class EloquentUserVehicleRepository implements UserVehicleInterface
{
    /**
     * Instance of DataTransform
     *
     * @var App\Motodash\Contracts\Modules\DataTransformer $transform
     */
    protected $transform;

    /**
     * Instance of UserVehicle
     *
     * @var $userVehicle
     */
    protected $userVehicle;

    /**
     * @param App\Models\UserVehicle                         $userVehicle
     * @param App\Motodash\Contracts\Modules\DataTransformer $transform
     */
    function __construct(UserVehicle $userVehicle, DataTransformer $transform){
        $this->userVehicle = $userVehicle;
        $this->transform = $transform;
    }

    /**
     * Get user vehicle with the most important information
     *
     * @param  int    $userVehicleId
     * @return string
     */
    public function vehicleMainInfo($userVehicleId)
    {
        return $this->transform
                    ->transformItem(
                        UserVehicle::vehicleMainInfo($userVehicleId),
                        UserVehiclesTransformer::class,
                        ['refuels', 'modifications']
                    );
    }

    /**
     * Get all vehicles owned by user
     *
     * @param  App\Models\User $user
     * @return array
     */
    public function userVehicles(User $user)
    {
        return $this->transform
                    ->transformCollection(
                        $user->userVehicles()->get(),
                        UserVehiclesTransformer::class
                    );
    }

    /**
     * Store new user vehicle in store
     *
     * @param  mixed           $request
     * @param  App\Models\User $user
     * @return array
     */
    public function newVehicle($request, User $user)
    {
        if(\Gate::denies('modify-user', $user)) {
            abort(403);
        }

        $requestWithoutFile = $request->all();
        $requestWithoutFile['thumbnail'] = $this->preparePhotoPath($request->file('thumbnail'));

        return $this->transform
                    ->transformItem(
                        $user->newVehicle($requestWithoutFile),
                        UserVehiclesTransformer::class
                    );
    }

    /**
     * Prepare photo path to store in storage
     *
     * @param  Illuminate\Http\UploadedFile $file
     * @return string
     */
    public function preparePhotoPath($file)
    {
        if(!$file || !$file->isValid()) {
            return '';
        }

        return $this->savePhoto($file);
    }

    /**
     * Save vehicle cover photos
     *
     * @param  Illuminate\Http\UploadedFile $file
     * @return string
     */
    private function savePhoto($file)
    {
        $fileName = $file->move(
                             storage_path('app/' . Config::get('motodash.userGallery') . Auth::id()),
                             str_slug('motodash' . ' ' . str_random(10))
                                 . '.' . $file->getClientOriginalExtension()
                         )
                         ->getFilename();

        $this->createThumbnail($fileName);

        return $fileName;
    }

    /**
     * Create thumbnail from request file
     *
     * @param  mixed $fileName
     * @return null
     */
    private function createThumbnail($fileName)
    {
        GraphicTransformer::makeThumbnail(
            Auth::id() . '/' . $fileName,
            'storage/gallery/' . Auth::id() . '/thumbnail-' . $fileName
        );
    }
}
