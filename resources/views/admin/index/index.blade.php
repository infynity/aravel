@extends('layouts.admin')
@section('content')

  <!-- content start -->
  <div class="admin-content">

    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">首页</strong> / <small>常用模块</small></div>
    </div>

    <ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list ">
      <li><a href="{{route('admin.good.index')}}" class="am-text-success"><span class="am-icon-btn am-icon-file-text"></span><br/>所有商品<br/>{{$g}}</a></li>
      <li><a href="{{ route('admin.order.index') }}" class="am-text-warning"><span class="am-icon-btn am-icon-briefcase"></span><br/>成交订单<br/>{{$o}}</a></li>
      <li><a href="{{ route('admin.comment.index') }}" class="am-text-danger"><span class="am-icon-btn am-icon-recycle"></span><br/>评论留言<br/>{{$c}}</a></li>
      <li><a href="{{ route('admin.user.index') }}" class="am-text-secondary"><span class="am-icon-btn am-icon-user-md"></span><br/>会员数<br/>{{$u}}</a></li>
    </ul>

    <div class="am-g">
      <div class="am-u-sm-12">
        <img src="{{ asset('img/s.jpg') }}" style="width: 100%;height:100%;" />
      </div>
    </div>


  </div>
  <!-- content end -->

@stop



