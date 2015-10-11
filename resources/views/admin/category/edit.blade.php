@extends('layouts.admin')
@section('content')
<div class="admin-content">

    <div class="am-cf am-padding">
        <div class="am-fl am-cf">
            <strong class="am-text-primary am-text-lg">商品管理</strong> / <small>编辑分类</small>
        </div>
    </div>

    @include('layouts._message')

    <form class="am-form" action="{{ route('admin.category.update', $category->id) }}" method="post">
        {!! csrf_field() !!}
        {!! method_field('put') !!}

        <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                分类名称
            </div>
            <div class="am-u-sm-8 am-u-md-4">
                <input type="text" class="am-input-sm" name="name" value="{{ $category->name }}">
            </div>
            <div class="am-hide-sm-only am-u-md-6">*必填，不可重复</div>
        </div>

        <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                上级分类
            </div>
            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                <select data-am-selected="{btnWidth: '100%',  btnStyle: 'secondary', btnSize: 'sm', maxHeight: 360, searchBox: 1}" name="parent_id">
                    <option value="0">顶级分类</option>
                    @foreach ($categories as $c)
                        <option value="{{ $c->id }}" @if($c->id == $category->parent_id) selected @endif>
                            {!! category_indent($c->count) !!}{{ $c->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                分类代表图片
            </div>
            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                <div class="am-form-group am-form-file">
                    <button type="button" class="am-btn am-btn-success am-btn-sm">
                        <i class="am-icon-cloud-upload" id="loading"></i> 选择要上传的图片
                    </button>
                    <input id="doc-form-file" type="file" multipleaa>
                    <input type="hidden" name="thumb" value="{{ $category->thumb }}" id="logo">
                </div>
                <div id="file-list"></div>
                <img src="{{ $category->thumb }}" alt="" id="brand_logo_img" style="max-width: 200px;"/>
            </div>
        </div>

        <div class="am-g am-margin-top">
            <div class="am-u-md-2 am-text-right">
                筛选属性
            </div>
            <div class="am-u-md-10">
                <button type="button" class="am-btn am-btn-warning am-round" id="add_filter">
                    <span class="am-icon-plus"> 新增</span>
                </button>
            </div>
        </div>



        @if($category->filter_attr->isEmpty())
            <div class="am-g am-margin-top filter">
                <div class="am-u-md-3 am-u-md-offset-2">
                    <select data-am-selected="{btnWidth: '100%', btnStyle: 'primary', btnSize: 'sm', maxHeight: 360, searchBox: 1}"
                            class="type select0">
                        <option value="-1">请选择商品类型</option>
                        @foreach ($types as $k=>$type)
                            <option value="{{ $k }}">
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="am-u-md-3">
                    <select data-am-selected="{btnWidth: '100%', btnStyle: 'secondary', btnSize: 'sm', maxHeight: 360, searchBox: 1}"
                            class="attributes" name="filter_attr[]">
                    </select>
                </div>
                <div class="am-u-md-2 am-u-end col-end">
                    <button type="button" class="am-btn am-btn-danger am-round">
                        <span class="am-icon-trash trash0"> 删除</span>
                    </button>
                </div>
            </div>
        @else
            @foreach( $category->filter_attr as $key=>$attr)
            <div class="am-g am-margin-top filter">
                <div class="am-u-md-3 am-u-md-offset-2">
                    <select data-am-selected="{btnWidth: '100%', btnStyle: 'primary', btnSize: 'sm', maxHeight: 360, searchBox: 1}"
                            class="type @if($key==0) select0 @endif">
                        <option value="-1">请选择商品类型</option>
                        @foreach ($types as $k=>$type)
                            <option value="{{ $k }}" @if($attr->type->id == $type->id) selected @endif>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="am-u-md-3">
                    <select data-am-selected="{btnWidth: '100%', btnStyle: 'secondary', btnSize: 'sm', maxHeight: 360, searchBox: 1}"
                            class="attributes" name="filter_attr[]">
                        @foreach($attr->type->attributes as $a)
                            <option value="{{$a->id}}" @if($attr->id == $a->id) selected @endif>
                                {{$a->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="am-u-md-2 am-u-end col-end">
                    <button type="button" class="am-btn am-btn-danger am-round">
                        <span class="am-icon-trash @if($key==0) trash0 @else trash @endif"> 删除</span>
                    </button>
                </div>
            </div>
            @endforeach
        @endif


        <div class="am-g am-margin-top sort">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                排序
            </div>
            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                <input type="text" name="sort_order" class="am-input-sm" value="{{ $category->sort_order }}">
            </div>
        </div>

        <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                是否显示
            </div>
            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                <input type="radio" name="is_show" value="1" @if($category->is_show == 1) checked @endif>是
                <input type="radio" name="is_show" value="0" @if($category->is_show == 0) checked @endif>否
            </div>
        </div>

        <div class="am-g am-margin-top">
            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                显示在导航栏
            </div>
            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                <input type="radio" name="show_in_nav" value="1" @if($category->show_in_nav == 1) checked @endif>是
                <input type="radio" name="show_in_nav" value="0"  @if($category->show_in_nav == 0) checked @endif>否
            </div>
        </div>


        <div class="am-g am-margin-top-sm">
            <div class="am-u-sm-12 am-u-md-2 am-text-right admin-form-text">
                分类描述
            </div>
            <div class="am-u-sm-12 am-u-md-10">
                <textarea rows="10" name="desc">{{ $category->desc }}</textarea>
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
<script src="{{ asset('js/upload.js') }}"></script>

<script>
    $(function() {
        $('#add_filter').click(function () {
            var filter = '<div class="am-g am-margin-top filter">' +
                    '<div class="am-u-md-3 am-u-md-offset-2">' +
                    '<select class="type">' +
                    '<option value="-1">请选择商品类型</option>' +
                    @foreach ($types as $k=>$type)
                        '<option value="{{ $k }}">{{ $type->name }}</option>' +
                    @endforeach
                    '</select>' +
                    '</div>' +
                    '<div class="am-u-md-3">' +
                    '<select class="attributes" name="filter_attr[]">' +
                    '</select>' +
                    '</div>' +
                    '<div class="am-u-md-2 am-u-end col-end">' +
                    '<button type="button" class="am-btn am-btn-danger am-round">' +
                    '<span class="am-icon-trash trash"> 删除</span>' +
                    '</button>' +
                    '</div>' +
                    '</div>';

            $('.sort').before(filter);

            //重设样式
            $('.type').selected({
                btnWidth: '100%',
                btnSize: 'sm',
                btnStyle: 'primary',
                maxHeight: '360',
                searchBox: '1'
            });
            $('.attributes').selected({
                btnWidth: '100%',
                btnSize: 'sm',
                btnStyle: 'secondary',
                maxHeight: '360',
                searchBox: '1'
            });
        });

        //删除筛选
        $(".trash0").click(function(){
            var $attributes = $(this).parents('.filter').find('.attributes');
            $attributes.empty();
            $(".select0 option:first").attr('selected', true);
        });
        $(document).on("click", ".trash",function() {
            $(this).parents(".filter").remove();
        });

        //筛选属性
        var types = {!! $types !!};


        $(document).on("change", ".type",function(){
            var html = '';
            var type_key = $(this).val();
            var $attributes = $(this).parents('.filter').find('.attributes');

            if (type_key == '-1') {
                $attributes.empty();
            } else {
                var attributes = types[type_key].attributes;
                $.each(attributes, function (k, v) {
                    html += '<option value="' + v.id + '">' + v.name + '</option>';
                })
                $attributes.html(html);
            }
        })
    });
</script>
@stop
