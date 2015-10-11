@extends('layouts.admin')
@section('content')
<div class="admin-content">
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">商品管理</strong> / <small>商品类型</small></div>
    </div>
    <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
            <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                    <a class="am-btn am-btn-default" href="{{route('admin.type.create')}}">
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
                            <th class="table-id">编号</th>
                            <th class="table-title">商品类型名称</th>
                            <th class="table-type">属性数</th>
                            <th class="table-set">操作</th>
                        </tr>
                    </thead>
                    <tbody>

                          @foreach($types as $type)
                        <tr>
                            <td>{{ $type->id }}</td>
                            <td>{{ $type->name }}</td>
                            <td>{{ $type->attributes->count() }}</td>
                            <td>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <a class="am-btn am-btn-default am-btn-xs am-text-success" style="background: greenyellow" href="{{ route('admin.type.{type_id}.attribute.index', $type->id) }}">
                                            <span class="am-icon-list"></span> 属性列表
                                        </a>
                                        <a class="am-btn am-btn-default am-btn-xs am-text-secondary" href="{{ route('admin.type.edit', $type->id) }}">
                                            <span class="am-icon-pencil-square-o"></span> 编辑
                                        </a>
                                        <a class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" href="{{ route('admin.type.destroy', $type->id) }}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="确定删除吗？">
                                            <span class="am-icon-trash-o"></span> 删除
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>

                <div class="am-cf">
                    <div class="am-fr">
                        {!! $types->render() !!}
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>
@stop
