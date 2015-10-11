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
 @if($order->status==0)
     <header data-am-widget="header" class="am-header am-header-default" style="background: orangered">
           <div class="am-header-left am-header-nav">

           </div>

           <h1 class="am-header-title">
              支付页面
           </h1>

           <div class="am-header-right am-header-nav">

           </div>
       </header>
  @endif
 @if($order->status==1)
     <header data-am-widget="header" class="am-header am-header-default" style="background: lightgreen">
           <div class="am-header-left am-header-nav">

           </div>

           <h1 class="am-header-title">
              订单信息
           </h1>

           <div class="am-header-right am-header-nav">

           </div>
       </header>
  @endif

      @if($order->status==2)
  <header data-am-widget="header" class="am-header am-header-default" style="background: cornflowerblue">
            <div class="am-header-left am-header-nav">

            </div>

            <h1 class="am-header-title">
               物流信息
            </h1>

            <div class="am-header-right am-header-nav">

            </div>
        </header>
      @endif
  <div data-am-widget="list_news" class="am-list-news am-list-news-default" >
  <!--列表标题-->
  <a href="###" class="">
    <div class="am-list-news-hd am-cf "style="background: lightcyan">
       <!--带更多链接-->

          <h2>{{$address->address}}&nbsp;&nbsp;&nbsp;{{$address->name}} </h2>
           <h2>电话:{{$address->tel}}</h2>

     </div>
   </a>

  <div class="am-list-news-bd">
<ul class="am-list">
 @foreach($order->order_goods as $g)
      <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-bottom-left">
          <h2 class="am-list-item-hd"><a href="" class="">{{$g->good->name}}</a></h3>
        <div class="am-u-sm-4 am-list-thumb">
          <a href="http://www.douban.com/online/11614662/" class="">
            <img src="{{$g->good->thumb}}" alt=""/>
          </a>
        </div>
        <a href="{{url('good', $g->good->id)}}">
        <div class=" am-u-sm-8  am-list-main">
            <div class="am-list-item-text"><span style="color:red;">￥{{$g->good->price}}<br>*{{$g->number}}</span></div>
        </div>
         <span class="am-list-news-more am-fr" style="font-size: 35px;"> &raquo;</span></a>
      </li>
 @endforeach
         {{--<select data-am-selected="{btnWidth: '100%', btnSize: 'sm', btnStyle: 'secondary'}">--}}
           {{--<option value="a">Apple</option>--}}
           {{--<option value="b">Banana</option>--}}
           {{--<option value="o">Orange</option>--}}
           {{--<option value="m">Mango</option>--}}
         {{--</select>--}}
      <li class="am-g am-list-item-desced">
          <h3 class="am-list-item-hd"><a href="" class="">商品金额</a> <span style="float: right;color: red;">￥{{number_format($order->total_price, 2)}}</span></h3>

        <div class=" am-list-main">
            {{--<div class="am-list-item-text" style="text-align: left;">运费</div>--}}
        </div>
      </li>
         <div class=" am-list-main">
                    {{--<div class="am-list-item-text" style="text-align: left;">总额</div>--}}
        </div>
    @if($order->status==0)
             <a href="{{url('pay', $order->id)}}">
            <button type="button" class="am-btn am-btn-lg am-btn-danger am-radius am-btn-block" id="add_cart">
                <i class="am-icon-credit-card"></i>
               点我模拟支付
            </button>
            </a>
    @endif
    @if($order->status==1)
              <a href="{{url('send', $order->id)}}">
             <button type="button" class="am-btn am-btn-lg am-btn-primary am-radius am-btn-block" id="add_cart">
                 <i class="am-icon-credit-card"></i>
                点我模拟发货
             </button>
             </a>
    @endif
</ul>
    @if($order->status==2)
         <a href="{{url('comment', $order->id)}}">
                        <button type="button" class="am-btn am-btn-lg am-btn-success am-radius am-btn-block" id="add_cart">
                            <i class="am-icon-credit-card"></i>
                           点我模拟收货,前往评论页
                        </button>
                        </a>
                        <br/>
  <iframe src="http://m.kuaidi100.com/index_all.html?type={{ $order->express->key}}&postid={{ $order->express_code}}" frameborder="0" width="100%" height="500"></iframe>
@endif


  </div>

</div>
@stop

