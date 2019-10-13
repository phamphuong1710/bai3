<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id', 'content', 'parent_id', 'product_id', 'store_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
