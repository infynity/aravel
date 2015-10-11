<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function express()
    {
        return $this->belongsTo('App\Models\Express');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }

    public function order_goods()
    {
        return $this->hasMany('App\Models\Order_good');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
