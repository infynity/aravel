<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//商品相册模型
class Good_gallery extends Model
{
    protected $guarded = [];

    public function good()
    {
        return $this->belongsTo('App\Models\Good');
    }

}
