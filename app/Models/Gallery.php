<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    /**
     * Get the user vehicles that owns the gallery.
     */
    public function userVehicles()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     * Get the vehicle that owns the gallery.
     */
    public function vehicles()
    {
        return $this->belongsTo('App\Models\Vehicle', 'vehicle_id', 'id');
    }

    /**
     * Get the photos for the blog gallery.
     */
    public function photos()
    {
        return $this->hasMany('App\Models\Photo', 'id', 'gallery_id');
    }
}
