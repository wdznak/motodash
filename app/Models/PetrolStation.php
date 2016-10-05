<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class PetrolStation extends Model
{
    /**
     * Get only petrol station name and id
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeName($query)
    {
        return $query->select(['id', 'station_brand']);
    }
}
