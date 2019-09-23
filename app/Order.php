<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'vnd', 'usd', 'quantity'
    ];

    public function orderDetail()
    {
        return $this->hasMany('App\OrderDetail');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
