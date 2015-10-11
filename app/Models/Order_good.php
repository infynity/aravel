<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_good extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function good()
    {
        return $this->belongsTo('App\Models\Good');
    }
}
