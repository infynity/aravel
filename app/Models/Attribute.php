<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $guarded = [];

    //一个类型有很多属性
    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }
}
