@extends('layouts.wechat')
@section('css')
    <style>
    .am-panel-bd {
       padding: 0;
       position: relative;
    }
    .am-panel-bd img{
        /*width:100%;*/
    }
    .am-panel {
        border:0;
    }
    .head{
     position: absolute;
     left:25%;
     top:50%;
     margin-top:-60px;
     margin-left:-60px;
    }
    .am-list-news-default .am-list-item-thumb-bottom-left .am-list-thumb, .am-list-news-default .am-list-item-thumb-bottom-right .am-list-thumb {
    max-height: 120px;
    overflow: hidden;
    }
    .am-list-item-text{
        font-size: 19px;
        text-align: right;
    }
    </style>
    @stop
@section('content')
<header data-am-widget="header" class="am-header am-header-default" style="background: orangered">
       <div class="am-header-left am-header-nav">

       </div>

       <h1 class="am-header-title">
          订单确认
       </h1>

       <div class="am-header-right am-header-nav">

       </div>
   </header>
<div data-am-widget="list_news" class="am-list-news am-list-news-default" >
<!--列表标题-->
<a href="/address/{{$user_id}}" class="">
<div class="am-list-news-hd am-cf "style="background: lightcyan">
   <!--带更多链接-->

      <h2>{{$address->address}}&nbsp;&nbsp;&nbsp;{{$address->name}}收 </h2>
       <h2>电话:{{$address->tel}}</h2>

        <span class="am-list-news-more am-fr">去修改 &raquo;</span>

 </div>
</a>
<div class="am-list-news-bd">
<ul class="am-list">

     <!--缩略图在标题下方居左-->

 @foreach($carts as $cart)
      <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-bottom-left">
          <h2 class="am-list-item-hd"><a href="" class="">{{$cart->good->name}}</a></h3>
        <div class="am-u-sm-4 am-list-thumb">
          <a href="http://www.douban.com/online/11614662/" class="">
            <img src="{{$cart->good->thumb}}" alt=""/>
          </a>
        </div>
        <a href="{{url('good', $cart->good->id)}}">
        <div class=" am-u-sm-8  am-list-main">

            <div class="am-list-item-text"><span style="color:red;">￥{{$cart->good->price}}<br>*{{$cart->number}}</span></div>

        </div>
         <span class="am-list-news-more am-fr" style="font-size: 35px;"> &raquo;</span></a>
      </li>
 @endforeach

      <li class="am-g am-list-item-desced">
          <h3 class="am-list-item-hd"><a href="" class="">商品金额</a> <span style="float: right;color: red;">￥{{number_format($total_price, 2)}}</span></h3>

        <div class=" am-list-main">

        </div>
        </li>
         <div class=" am-list-main">

        </div>

        <a href="{{url('pay', $cart->order_id)}}">
        <button type="button" class="am-btn am-btn-lg am-btn-danger am-radius am-btn-block" id="add_cart">
            <i class="am-icon-credit-card"></i>
           点我模拟支付
        </button>
        </a>

    </ul>

  </div>

</div>
@stop

