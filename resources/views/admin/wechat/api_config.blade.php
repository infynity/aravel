@extends('layouts.admin')
@section('css')
    <style>
        .am-form textarea {
            font-size: 14px;
            line-height: 1.6;
        }
    </style>
@stop

@section('content')
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf">
                <strong class="am-text-primary am-text-lg">微信管理</strong> /
                <small>接口配置</small>
            </div>
        </div>

        @include('layouts._message')

        <form class="am-form" action="/admin/wechat/set_config" method="post">
            {!! csrf_field() !!}
            {!! method_field('put') !!}

            <div class="am-g am-margin-top">
                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                    接口配置
                </div>
                <div class="am-u-sm-8 am-u-md-10">
                    <textarea class="" name="config" rows="8" spellcheck="false">{{ $config }}</textarea>
                </div>
            </div>

            <div class="am-margin">
                <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
            </div>
        </form>

    </div>
@stop
