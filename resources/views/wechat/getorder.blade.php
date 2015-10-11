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

@if($orders->count()==0)
      <img src="{{ asset('img/2015-10-11_120048.jpg') }}" style="width: 100%;height:100%;" data-rel="http://s.amazeui.org/media/i/demos/pure-1.jpg" alt="春天的花开秋天的风以及冬天的落阳"/>

@else
<header data-am-widget="header" class="am-header am-header-default" style="background: orangered">
<div class="am-header-left am-header-nav">

</div>

<h1 class="am-header-title">
 全部订单
</h1>

<div class="am-header-right am-header-nav">

</div>
</header>
 @foreach($orders as $order)
<div class="am-panel am-panel-default">
  <div class="am-panel-hd">时间：{{$order->created_at}} <span style="float:right;color:red;">{{order_status($order->status)}}</span></div>

   @if($order->status == 3) <a href="{{url('/getmycom', $order->id)}}"> @else   <a href="{{url('oneorder', $order->id)}}">@endif
<div class="am-panel-bd">
 <ul data-am-widget="gallery" class="am-gallery am-avg-sm-3 am-avg-md-3 am-avg-lg-4 am-gallery-default"  >
         @foreach($order->order_goods as $g)
  <li>
    <div class="am-gallery-item">
          <img src="{{$g->good->thumb}}"  alt=""/>
            <h3 class="am-gallery-title">{{$g->good->name}}</h3>
    </div>
  </li>
         @endforeach
  </ul>
</div></a>
      <footer class="am-panel-footer">实际金额：￥{{$order->total_price}}
        @if($order->status==0)
      <a href="{{url('oneorder', $order->id)}}"><button type="button" class="am-btn am-btn-xs am-btn-danger am-radius" style="float: right">立即支付</button></footer></a>
         @endif
         @if($order->status==2)
          <button type="button" class="am-btn am-btn-xs am-btn-warning am-radius" style="float: right">确认收货</button></footer>
        @endif
</div>
  @endforeach
 @endif
@stop

