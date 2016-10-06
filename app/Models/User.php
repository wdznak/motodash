<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use PhotoManager;
    /**
     * The booting method of the model
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($userVehicle) {
            $userVehicle->userVehicles()->delete();
        });
    }

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the user vehicles details for the user
     */
    public function userVehicleDetails()
    {
        return $this->userVehicles()->with('modifications');
    }

    /**
     * Get the userVehicles for the user.
     */
    public function userVehicles()
    {
        return $this->hasMany('App\Models\UserVehicle', 'user_id', 'id');
    }

    /**
     * Store new user vehicle in database
     *
     * @param  mixed $request
     */
    public function newVehicle($request)
    {
        $modRequest = $request->all();
        $modRequest['thumbnail'] = $this->savePhotoWithThumbnail($request->file('thumbnail'));

        return $this->userVehicles()->save(new UserVehicle($modRequest));
    }
}
