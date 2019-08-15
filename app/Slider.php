<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    public function image()
    {
        return $this->hasOne('App\Media');
    }
}
