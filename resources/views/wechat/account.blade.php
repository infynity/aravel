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
    </style>
    @stop
@section('content')

<div class="am-panel am-panel-default">
    <div class="am-panel-bd">
    <img src="{{ asset('img/201405191144275544.jpg') }}" width="100%" alt=""/>
    <img class="am-circle head" src="{{$headimg}}" width="120" height="120"/>
    </div>
</div>


    <nav data-am-widget="menu" class="am-menu  am-menu-stack">
        <a href="javascript: void(0)" class="am-menu-toggle">
            <i class="am-menu-toggle-icon am-icon-bars"></i>
        </a>


        <ul class="am-menu-nav am-avg-sm-1">
            <li class="">
                <a href="/getorder" class="" ><span class="am-icon-server am-icon-sm"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单查询</a>
                <a href="/wpay" class="" ><span class="am-icon-credit-card am-icon-sm"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;代付款订单
                 <span class="am-badge am-badge-danger am-round"  id="wpay" style="float: right;position:absolute;top:15px;right:10px;">{{$wpay}}</span>
</a>
                <a href="/address/{{$user_id}}" class="" ><span class="am-icon-home am-icon-sm"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;地址管理</a>
                <a href="/user_info/{{$user_id}}" class="" ><span class="am-icon-user am-icon-sm"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;用户信息</a>
            </li>
        </ul>
    </nav>
@stop

