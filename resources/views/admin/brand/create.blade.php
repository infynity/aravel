@extends('layouts.admin')
@section('content')
<div class="admin-content">

    <div class="am-cf am-padding">
        <div class="am-fl am-cf">
            <strong class="am-text-primary am-text-lg">商品管理</strong> / <small>添加商品</small>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="am-form" action="{{ route('admin.brand.store') }}"  method="post">
        {!! csrf_field() !!}
        <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                商品品牌
            </div>
            <div class="am-u-sm-8 am-u-md-4">
                <input type="text" class="am-input-sm" name="name">
            </div>
            <div class="am-hide-sm-only am-u-md-6">*必填，不可重复</div>
        </div>

        <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                品牌网址
            </div>
            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                <input type="text" class="am-input-sm" name="url">
            </div>
        </div>


        <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                品牌LOGO
            </div>
            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                <div class="am-form-group am-form-file">
                    <button type="button" class="am-btn am-btn-success am-btn-sm">
                        <i class="am-icon-cloud-upload"></i> 选择要上传的logo
                    </button>
                    <input id="doc-form-file" type="file" multipleaa>
                    <input type="hidden" name="logo" value="" id="logo">
                </div>
                <div id="file-list">
                </div>
                <img src="" alt="" id="brand_logo_img" style="max-width: 200px;"/>
            </div>
        </div>

        <div class="am-g am-margin-top-sm">
            <div class="am-u-sm-12 am-u-md-2 am-text-right admin-form-text">
                品牌描述
            </div>
            <div class="am-u-sm-12 am-u-md-10">
                <textarea rows="10" name="desc"></textarea>
            </div>
        </div>

        <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                是否显示
            </div>
            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                <input type="radio" name="is_show" value="1" checked>是
                <input type="radio" name="is_show" value="0">否
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
<script src="{{ asset('js/jquery.html5-fileupload.js') }}"></script>

<script>
$(function() {

    //文件上传
    $('#doc-form-file').on('change', function() {
        var fileNames = '';
        $.each(this.files, function() {
            fileNames += '<span class="am-badge">' + this.name + '</span> ';
        });
        $('#file-list').html(fileNames);
    });

    var opts = {
        url: "/upload",
        type: "POST",
        beforeSend: function(){

        },

        success : function (result, status, xhr){
            $('#logo').val(result.info);
            $('#brand_logo_img ').attr('src',result.info);
            console.log(result);
        },

        error : function(result, status, errorThrown){
        }
    }


    $('#doc-form-file').fileUpload(opts);

});
</script>
@stop
