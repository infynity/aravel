<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Good extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = [];
    //每个商品都属于某一个品牌
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    //每个商品都属于某一个分类
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    //一个商品有很多属性
    public function good_attrs()
    {
        return $this->hasMany('App\Models\Good_attr');
    }

    //一个商品有很多相册图片
    public function good_galleries()
    {
        return $this->hasMany('App\Models\Good_gallery');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
