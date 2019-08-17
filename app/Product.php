<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'price', 'price_sale', 'quantity_stock', 'category_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var  array
     */
    protected $dates = ['deleted_at'];

    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function media()
    {
        return $this->hasMany('App\Media');
    }

    public function rating()
    {
        return $this->hasMany('App\Rating');
    }
}
