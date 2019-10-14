<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address', 'lat', 'lng', 'active'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var  array
     */
    protected $dates = ['deleted_at'];
}
