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
     left:50%;
     top:50%;
     margin-top:-60px;
     margin-left:-60px;
    }
    </style>
    @stop
@section('content')
<div class="am-panel am-panel-default">
    <div class="am-panel-bd">
    <img src="{{ asset('img/86ad89eegw1dy0jhj82buj.jpg') }}" width="100%" alt=""/>
    <img class="am-circle head" src="{{$user_info->headimgurl}}" width="120" height="120"/>
    </div>
</div>
 <section data-am-widget="accordion" class="am-accordion am-accordion-gapped" data-am-accordion='{  }'>
      <dl class="am-accordion-item am-active">
        <dt class="am-accordion-title">
          个人信息
        </dt>
        <dd class="am-accordion-bd am-collapse am-in">
          <!-- 规避 Collapase 处理有 padding 的折叠内容计算计算有误问题， 加一个容器 -->
          <div class="am-accordion-content">
          昵称 <br/> —— {{$user_info->nickname}} <br/>
          现在 <br/> —— {{$user_info->province}}{{$user_info->city}} <br/>
          首次进入infynity商城时间 <br/>—— {{$user_info->created_at}}
          </div>
        </dd>
      </dl>
      <dl class="am-accordion-item">
        <dt class="am-accordion-title">
          消费记录
        </dt>
        <dd class="am-accordion-bd am-collapse ">
          <div class="am-accordion-content">
          @if($orders->count()==0)
           您还没有消费记录
          @else
            @foreach($orders as $order)
                      {{$order->created_at}} 消费 ￥<span style="color: red">{{$order->total_price}}</span>元<br/>
                    @endforeach
          @endif
          </div>
        </dd>
      </dl>
      <dl class="am-accordion-item">
        <dt class="am-accordion-title">
        收货信息
        </dt>
        @if($address)
        <dd class="am-accordion-bd am-collapse ">
          <div class="am-accordion-content">
                        {{$address->address}}&nbsp;{{$address->name}}收<br>
                          联系方式：{{$address->tel}}
          </div>
        </dd>
        @else
       <dd class="am-accordion-bd am-collapse ">
          <div class="am-accordion-content">
                        您还没设置地址
          </div>
        </dd>
        @endif
      </dl>
  </section>
@stop

@section('js')
<script>


</script>
@stop

