<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Query;
use Auth;

class UserVehicle extends Model
{
    /**
     * The booting method of the model
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('vehicles', function(Builder $builder) {
            $builder->with('vehicles');
        });

        static::deleting(function($userVehicle) {
            $userVehicle->refuels()->delete();
        });
    }

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'user_id',
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
     * Scope a query to fetch most relevant information for
     * specific vehicle
     *
     * @param int $vehicleId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVehicleMainInfo($query, $vehicleId)
    {
        return $query->where('id', '=', $vehicleId)
                     ->withCount('refuels', 'modifications')
                     ->with('latestRefuels', 'modifications')
                     ->first();
    }

    /**
     * Get only latest refuels for userVehicle
     */
    public function latestRefuels()
    {
        return $this->refuels()->latestRefuels();
    }

    /**
     * Get the refuels for the userVehicle.
     */
    public function refuels()
    {
        return $this->hasMany('App\Models\Refuel', 'user_vehicle_id', 'id');
    }

    /**
     * Get the galleries for the userVehicle.
     */
    public function galleries()
    {
        return $this->hasMany('App\Models\Gallery', 'user_vehicle_id', 'id');
    }

    /**
     * Get the modifications for the userVehicle.
     */
    public function modifications()
    {
        return $this->hasMany('App\Models\Modification', 'user_vehicle_id', 'id');
    }

    /**
     * Get the user that owns the userVehicle.
     */
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     * Get the vehicle that owns the userVehicle.
     */
    public function vehicles()
    {
        return $this->belongsTo('App\Models\Vehicle', 'vehicle_id', 'id');
    }
}
