@extends('layouts.wechat')
@section('content')
<div class="addr">
<form action="/address"  method="post" class="form1">
         {!! csrf_field() !!}
    <div class="am-panel am-panel-primary  ">
      <div class="am-panel-hd">
      <h3 class="am-panel-title">默认地址 </h3>
      <input type="hidden" name="user_id" value="{{$user_id}}"/>
      <div class="am-input-group">
        <span class="am-input-group-label">收货人</span>
        <input type="text" class="am-form-field" placeholder="必填*" name="name" id="pl">
      </div>

      <div class="am-input-group">
        <span class="am-input-group-label">手机号</span>
        <input type="text" class="am-form-field" placeholder="必填*" name="tel" id="tel">
      </div>
       <div class="am-input-group">
         <span class="am-input-group-label">收货地</span>
        <input type="text" class="am-form-field" placeholder="必填*" name="address" id="adr">
      </div>
      </div>

    </div>
</form>
<button type="button" class="am-btn am-btn-warning am-btn-block am-round add_addr">保存地址信息</button>
</div>
  <img src="{{ asset('img/dab44bede0.jpg') }}" style="width: 100%;height:380px;" />


@stop

@section('js')
<script>
    $('.add_addr').click(function(){
      if( $('#pl').val()==""||$('#tel').val()==""||$('#adr').val()=="" ) {
            alert('请不要有空项！')
             return false;
      }else{
             $('.form1').submit();
      }
    })

</script>
@stop

