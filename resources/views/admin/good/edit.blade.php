@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('webupload/dist/webuploader.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('webupload/style.css') }}"/>
@stop
@section('content')
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf">
                <strong class="am-text-primary am-text-lg">商品管理</strong> /
                <small>编辑商品</small>
            </div>
        </div>

        @include('layouts._message')

        <form class="am-form" action="{{route('admin.good.update', $good->id)}}" method="post">
            {!! csrf_field() !!}
            {!! method_field('put') !!}

            <div class="am-tabs am-margin" data-am-tabs>
                <ul class="am-tabs-nav am-nav am-nav-tabs">
                    <li class="am-active"><a href="#tab1">通用信息</a></li>
                    <li><a href="#tab2">商品属性</a></li>
                    <li><a href="#tab3">商品相册</a></li>
                </ul>

                <div class="am-tabs-bd">
                    <div class="am-tab-panel am-fade am-in am-active" id="tab1">

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                商品名称
                            </div>
                            <div class="am-u-sm-8 am-u-md-4">
                                <input type="text" class="am-input-sm" name="name" value="{{ $good->name }}">
                            </div>
                            <div class="am-hide-sm-only am-u-md-6">*必填</div>
                        </div>

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">商品分类</div>
                            <div class="am-u-sm-8 am-u-md-4">
                                <select name="category_id" data-am-selected="{btnStyle: 'secondary', btnSize: 'sm', maxHeight: 360}">
                                    <option value=''>请选择...</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if($good->category_id == $category->id) selected @endif>
                                            {!! category_indent($category->count) !!}{{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="am-hide-sm-only am-u-md-6">*必填</div>
                        </div>

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">商品品牌</div>
                            <div class="am-u-sm-8 am-u-md-10">
                                <select data-am-selected="{btnStyle: 'secondary', btnSize: 'sm', maxHeight: 360}" name="brand_id">
                                    <option value=''>请选择...</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}" @if($good->brand_id == $brand->id) selected @endif>
                                            {{$brand->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                商品价格
                            </div>
                            <div class="am-u-sm-8 am-u-md-4">
                                <input type="number" class="am-input-sm" name="price" value="{{ $good->price }}">
                            </div>
                            <div class="am-hide-sm-only am-u-md-6 am-u-end">*必填</div>
                        </div>

                        {{--缩略图--}}

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                商品库存数量
                            </div>
                            <div class="am-u-sm-8 am-u-md-4 am-u-end">
                                <input type="number" class="am-input-sm" name="number" value="{{ $good->number }}">
                            </div>
                        </div>

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">加入推荐</div>
                            <div class="am-u-sm-8 am-u-md-10">
                                <div class="am-btn-group" data-am-button>

                                    <label class="am-btn am-btn-default am-btn-xs @if($good->best == 1) am-active @endif">
                                        <input type="checkbox" name="best" value="1" @if($good->best == 1) checked @endif>
                                        精品
                                    </label>
                                    <label class="am-btn am-btn-default am-btn-xs @if($good->new == 1) am-active @endif">
                                        <input type="checkbox" name="new" value="1" @if($good->new == 1) checked @endif>
                                        新品
                                    </label>
                                    <label class="am-btn am-btn-default am-btn-xs @if($good->hot == 1) am-active @endif">
                                        <input type="checkbox" name="hot" value="1" @if($good->hot == 1) checked @endif>
                                        热销
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">上架</div>
                            <div class="am-u-sm-8 am-u-md-10">
                                <div class="am-btn-group">

                                    <input type="checkbox" value="1" name="onsale" @if($good->onsale == 1) checked @endif>
                                    选中表示允许销售，否则不允许销售。
                                </div>
                            </div>
                        </div>

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                商品缩略图
                            </div>
                            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                <div class="am-form-group am-form-file">
                                    <button type="button" class="am-btn am-btn-success am-btn-sm">
                                        <i class="am-icon-cloud-upload" id="loading"></i> 选择要上传的缩略图
                                    </button>
                                    <input id="doc-form-file" type="file" multipleaa>
                                    <input type="hidden" name="thumb" value="{{ $good->thumb }}" id="logo">
                                </div>
                                <div id="file-list"></div>
                                <img src="{{ $good->thumb }}" alt="" id="brand_logo_img"  style="max-width: 200px;"/>
                            </div>
                        </div>

                        <div class="am-g am-margin-top-sm">
                            <div class="am-u-sm-12 am-u-md-2 am-text-right admin-form-text">
                                内容描述
                            </div>
                            <div class="am-u-sm-12 am-u-md-10">
                                <textarea rows="16" placeholder="请使用富文本编辑插件" id="editor_id" name="desc">{{ $good->desc }}</textarea>
                            </div>
                        </div>

                    </div>

                    <div class="am-tab-panel am-fade" id="tab2" style="min-height:500px;">

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">商品类型</div>
                            <div class="am-u-sm-8 am-u-md-4 am-u-end">
                                <select data-am-selected="{btnStyle: 'secondary', btnSize: 'sm', maxHeight: 360}" id="select_type" name="type_id">
                                    <option value="" data-type_key="">请选择...</option>
                                    @foreach ($types as $key=>$type)
                                        <option value="{{ $type->id }}" data-type_key="{{$key}}" @if($good->type_id == $type->id) selected @endif>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div id="attributes"></div>

                    </div>

                    <div class="am-tab-panel am-fade" id="tab3">

                        <ul class="am-avg-sm-2 am-avg-md-4 am-avg-lg-6 am-margin gallery-list">
                            @foreach($good->good_galleries as $gallery)
                                <li>
                                    <a href="#">
                                        <img class="am-img-thumbnail am-img-bdrs" src="{{$gallery->img}}" alt=""/>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <div id="uploader">
                            <div class="queueList">
                                <div id="dndArea" class="placeholder">
                                    <div id="filePicker"></div>
                                    <p>或将照片拖到这里，1单次最多可选300张</p>
                                </div>
                            </div>
                            <div class="statusBar" style="display:none;">
                                <div class="progress">
                                    <span class="text">0%</span>
                                    <span class="percentage"></span>
                                </div>
                                <div class="info"></div>
                                <div class="btns">
                                    <div id="filePicker2"></div>
                                    <div class="uploadBtn">开始上传</div>
                                </div>
                            </div>

                            <div id="imgs"></div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="am-margin">
                <button type="submit" class="am-btn am-btn-primary am-btn-xs">保存</button>
            </div>

        </form>

    </div>
@stop


@section('js')
    <script src="{{ asset('js/jquery.html5-fileupload.js') }}"></script>
    <script src="{{ asset('js/upload.js') }}"></script>
    <script src="{{ asset('kindeditor/kindeditor-min.js') }}"></script>
    <script src="{{ asset('kindeditor/lang/zh_CN.js') }}"></script>
    <script>
        KindEditor.ready(function (K) {
            window.editor = K.create('#editor_id');
        });

        var good_attrs = {!! $good->good_attrs !!};
        var types = {!! $types !!};
        var good_type_id = {!! $good->type_id !!};
    </script>
    <script src="{{ asset('js/edit_good.js') }}"></script>
    <script type="text/javascript" src="{{asset('webupload/dist/webuploader.js')}}"></script>
    <script type="text/javascript" src="{{asset('webupload/upload.js')}}"></script>
@stop
