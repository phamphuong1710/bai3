<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var  array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id', 'total_price', 'total_product', 'discount'
    ];

    public function detail()
    {
        return $this->hasMany('App\CartDetail');
    }
}
