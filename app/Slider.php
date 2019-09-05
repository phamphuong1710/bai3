<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    public function media()
    {
        return $this->hasOne('App\Media');
    }

    public function store()
    {
        return $this->belongsTo('App\Store');
    }
}
