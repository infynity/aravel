<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Express extends Model
{
    protected $guarded = [];

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
