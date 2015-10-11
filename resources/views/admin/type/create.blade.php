@extends('layouts.admin')
@section('content')
<div class="admin-content">

    <div class="am-cf am-padding">
        <div class="am-fl am-cf">
            <strong class="am-text-primary am-text-lg">商品类型</strong> / <small>新建商品类型</small>
        </div>
    </div>

    @include('errors._list')

    <form class="am-form" action="{{ route('admin.type.store') }}" method="post">
        {!! csrf_field() !!}

        <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                商品类型名称
            </div>
            <div class="am-u-sm-8 am-u-md-4">
                <input type="text" class="am-input-sm" name="name">
            </div>
            <div class="am-hide-sm-only am-u-md-6">*必填，不可重复</div>
        </div>

        <div class="am-margin">
            <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
        </div>
    </form>

</div>
@stop
