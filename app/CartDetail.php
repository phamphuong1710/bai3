<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    protected $fillable = [
        'product_id', 'unit_price', 'quantity', 'discount'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
