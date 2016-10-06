<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Refuel extends Model
{
    /**
     * The booting method of the model
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('details', function(Builder $builder) {
            $builder->with('petrolStationName', 'fuelTypes');
        });
    }

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'user_vehicle_id',
    ];

    /**
     * Scope a query to only include latest refuels
     *
     * @param  integer $limit
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeLatestRefuels($query, $limit = 4){
        return $query->latest()
                     ->limit($limit);
    }

    /**
     * Scope a query to only refuels from last month
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeLastMonth($query)
    {
        return $query->where('created_at', '>', Carbon::now()->subMonth());
    }

    /**
     * Get the fuel type for the refuel.
     */
    public function fuelTypes(){
        return $this->hasOne('App\Models\FuelType', 'id', 'fuel_type_id');
    }

    /**
     * Get only petrol station brand name for the refuel
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function petrolStationName()
    {
        return $this->petrolStations()->name();
    }

    /**
     * Get the fuel type for the refuel.
     */
    public function petrolStations(){
        return $this->hasOne('App\Models\PetrolStation', 'id', 'petrol_station_id');
    }

    /**
     * Get the user vehicle that owns the refuel.
     */
    public function userVehicles(){
        return $this->belongsTo('App\Models\UserVehicle', 'user_vehicle_id', 'id');
    }

}
