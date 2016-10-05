<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand',
        'model',
        'type',
        'produced_from',
        'produced_to'
    ];

    /**
    * The attributes that are hidden from arrays.
    *
    * @var array
    */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * Get the usersVehicles for the vehicle.
     */
    public function usersVehicles()
    {
      return $this->hasMany('App\Models\UserVehicle', 'vehicle_id', 'id');
    }

    /**
     * Get the galeries for the vehicle.
     */
    public function galeries()
    {
        return $this->hasMany('App\Models\Gallery', 'vehicle_id', 'id');
    }
}
