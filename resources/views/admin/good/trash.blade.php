@extends('layouts.admin')
@section('content')
<div class="admin-content">
    <div class="am-cf am-padding">
        <div class="am-fl am-cf">
            <strong class="am-text-primary am-text-lg">商品管理</strong> / <small>商品回收站</small>
        </div>
    </div>

    @include('layouts._message')

    <div class="am-g">

    </div>

    <div class="am-g">
        <div class="am-u-sm-12">
            <form class="am-form">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                        <tr>
                            <th class="table-id">编号</th>
                            <th class="table-title">商品名称</th>
                            <th>商品缩略图</th>
                            <th>价格</th>
                            <th class="table-set">操作</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach($goods as $good)
                        <tr>
                            <td class="good_id">{{ $good->id }}</td>
                            <td>{{ $good->name }}</td>
                            <td class="brand_logo"><img src="{{ $good->thumb }}" alt="" style="max-width: 80px;"/>
                            </td>
                            <td>{{ $good->price }}</td>

                            <td>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <a class="am-btn am-btn-default am-btn-xs am-text-secondary" href="{{ route('admin.good.restore', $good->id) }}">
                                            <span class="am-icon-pencil-square-o"></span> 还原
                                        </a>
                                        <a class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" href="{{ route('admin.good.force_destroy', $good->id) }}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="确定删除吗？">
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

                        {!! $goods->render() !!}
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>
@stop

@section('js')
<script type="text/javascript">
    $(function(){

    })
</script>
@stop
