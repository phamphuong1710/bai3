<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'phone', 'user_id', 'description'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var  array
     */
    protected $dates = ['deleted_at'];
}
