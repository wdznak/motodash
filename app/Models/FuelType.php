<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuelType extends Model
{
    /**
     * Scope a query to fetch only id and fuel type
     *
     * @param int $vehicleId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeName($query)
    {
        return $query->select(['id', 'fuel_type']);
    }
}
