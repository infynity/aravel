<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //这里必须加黑名单  且为空
    protected $guarded = [];
}
