@extends('layouts.admin')
@section('content')
<div class="admin-content">
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">商品管理</strong> / <small>商品分类</small></div>
    </div>

    @include('layouts._message')

    <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
            <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                    <a class="am-btn am-btn-default" href="{{ route('admin.category.create') }}">
                        <span class="am-icon-plus"></span> 新增
                    </a>
                </div>
            </div>
        </div>



    </div>

    <div class="am-g">
        <div class="am-u-sm-12">
            <form class="am-form">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                        <tr>
                            <th class="table-title">分类名称</th>
                            {{--<th>商品数量</th>--}}
                            <th>导航栏</th>
                            <th>是否显示</th>
                            <th >排序</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach($categories as $category)
                        <tr>
                            <td class="table-title">
                                {!! category_indent($category->count) !!}
                                {{ $category->name }}
                            </td>
                            {{--<td>1</td>--}}
                            <td class="am-hide-sm-only">
                                @if($category->show_in_nav == true)
                                    <span class="am-icon-check"></span>
                                @else
                                    <span class="am-icon-close"></span>
                                @endif
                            </td>
                            <td class="am-hide-sm-only">
                                @if($category->is_show == true)
                                    <span class="am-icon-check"></span>
                                @else
                                    <span class="am-icon-close"></span>
                                @endif
                            </td>
                            <td class="am-hide-sm-only sort_order">{{ $category->sort_order }}</td>

                            <td>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <a class="am-btn am-btn-default am-btn-xs am-text-secondary" href="{{ route('admin.category.edit', $category->id) }}">
                                            <span class="am-icon-pencil-square-o"></span> 编辑
                                        </a>
                                        <a class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" href="{{ route('admin.category.destroy', $category->id) }}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="确定删除吗？">
                                            <span class="am-icon-trash-o"></span> 删除
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>


            </form>
        </div>
    </div>

</div>
@stop

