<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * Get the vehicles that owns the photo.
     */
    public function vehicles()
    {
        return $this->belongsTo('App\Models\Vehicle', 'vehicle_id', 'id');
    }

    /**
     * Get the galleries that owns the photo.
     */
    public function galleries()
    {
        return $this->belongsTo('App\Models\Gallery', 'gallery_id', 'id');
    }
}
