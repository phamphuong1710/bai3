<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartDetail extends Model
{
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var  array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'product_id', 'unit_price', 'quantity', 'discount'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
