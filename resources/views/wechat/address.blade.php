@extends('layouts.wechat')
@section('content')
<div class="addr">
<form action="/address/update/{{$address_id}}"  method="post" class="form1">
         {!! csrf_field() !!}
            {!! method_field('put') !!}
@foreach($addresses as $k=>$address)
    <div class="am-panel am-panel-primary  @if($k==1) am-panel-danger @endif @if($k==2) am-panel-success @endif">
      <div class="am-panel-hd">
      <h3 class="am-panel-title">@if($k==0) 默认地址 @endif @if($k==1) 地址2 @endif @if($k==2) 地址3 @endif</h3>
      <input type="hidden" name="user_id" value="{{$address->user_id}}"/>
      <div class="am-input-group">
        <span class="am-input-group-label">收货人</span>
        <input type="text" class="am-form-field" placeholder="必填*" name="name" value="{{$address->name}}">
      </div>

      <div class="am-input-group">
        <span class="am-input-group-label">手机号</span>
        <input type="text" class="am-form-field" placeholder="必填*" name="tel" value="{{$address->tel}}">
      </div>
       <div class="am-input-group">
         <span class="am-input-group-label">收货地</span>
        <input type="text" class="am-form-field" placeholder="必填*" name="address" value="{{$address->address}}">
      </div>
      </div>

    </div>
@endforeach

</form>
<div style="padding: 5px">
<button type="button" class="am-btn am-btn-warning am-btn-block am-round add_addr">修改地址信息</button>
</div>

<div style="padding: 5px">
<button type="button" class="am-btn am-btn-success am-btn-block am-round ">新增地址信息</button>
</div>
</div>
  <img src="{{ asset('img/2015928171444.jpg') }}" style="width: 100%;height:380px;" />
<h3>打个小广告~</h3>
@stop

@section('js')
<script>
    $('.add_addr').click(function(){

       $('.form1').submit();

    })

</script>
@stop

