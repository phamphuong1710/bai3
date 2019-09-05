<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id', 'total_price', 'total_product', 'discount'
    ];

    public function detail()
    {
        return $this->hasMany('App\CartDetail');
    }
}
