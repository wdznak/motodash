<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mod_name',
        'value',
        'price',
    ];
}
