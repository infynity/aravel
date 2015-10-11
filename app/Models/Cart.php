<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $guarded = [];
    public function good(){
        return $this->belongsTo('App\Models\Good');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
