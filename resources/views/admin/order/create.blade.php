@extends('layouts.admin')
@section('content')
<div class="admin-content">

    <div class="am-cf am-padding">
        <div class="am-fl am-cf">
            <strong class="am-text-primary am-text-lg">系统设置</strong> / <small>添加物流</small>
        </div>
    </div>

    @include('layouts._message')

    <form class="am-form" action="{{ route('admin.express.store') }}" method="post">
        {!! csrf_field() !!}

        <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                物流名称
            </div>
            <div class="am-u-sm-8 am-u-md-4">
                <input type="text" class="am-input-sm" name="name">
            </div>
            <div class="am-hide-sm-only am-u-md-6">*必填，不可重复</div>
        </div>

        <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                物流运费
            </div>
            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                <input type="text" class="am-input-sm" name="shipping_money">
            </div>
        </div>

        <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                满额免物流费
            </div>
            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                <input type="text" class="am-input-sm" name="shipping_free">
            </div>
        </div>

        <div class="am-g am-margin-top-sm">
            <div class="am-u-sm-12 am-u-md-2 am-text-right admin-form-text">
                物流描述
            </div>
            <div class="am-u-sm-12 am-u-md-10">
                <textarea rows="10" name="desc"></textarea>
            </div>
        </div>

        <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                是否可用
            </div>
            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                <input type="radio" name="enabled" value="1" checked>是
                <input type="radio" name="enabled" value="0">否
            </div>
        </div>

        <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                排序
            </div>
            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                <input type="text" name="sort_order" class="am-input-sm" value="99">
            </div>
        </div>

        <div class="am-margin">
            <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
        </div>
    </form>



</div>
@stop


@section('js')
@stop
