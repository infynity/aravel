@extends('layouts.admin')

@section('content')
<div class="admin-content">
    <div class="am-cf am-padding">
        <div class="am-fl am-cf">
            <strong class="am-text-primary am-text-lg">商品管理</strong> / <small>商品列表</small>
        </div>
    </div>

    @include('layouts._message')

    <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
            <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                    <a class="am-btn am-btn-default" href="{{ route('admin.good.create') }}">
                        <span class="am-icon-plus"></span> 新增
                    </a>
                </div>
            </div>
        </div>

        <form class="" action="{{route('admin.good.search')}}" method="get">
            <div class="am-u-sm-12 am-u-md-3">
                <div class="am-input-group am-input-group-sm">
                    <input type="text" class="am-form-field" name="keyword" placeholder="根据商品名搜索">
                    <span class="am-input-group-btn">
                        <button class="am-btn am-btn-default" type="submit">搜索</button>
                    </span>
                </div>
            </div>
        </form>

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
                            <th>分类</th>
                            <th>价格</th>
                            <th class="am-hide-sm-only">上架</th>
                            <th class="am-hide-sm-only">精品</th>
                            <th class="am-hide-sm-only">新品</th>
                            <th class="am-hide-sm-only">热销</th>
                            {{--<th class="am-hide-sm-only">推荐排序</th>--}}
                            <th class="am-hide-sm-only">库存</th>
                            <th class="table-set">操作</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach($goods as $good)
                        <tr>
                            <td class="good_id">{{ $good->id }}</td>
                            <td>{{ $good->name }}</td>
                            <td class="brand_logo"><img src="{{ $good->thumb }}" alt=""  id="logoimg"/></td>
                            <td>{{ $good->category->name }}</td>

                            <td>{{ $good->price }}</td>

                            <td class="am-hide-sm-only">
                                @if($good->onsale)
                                    <span class="am-icon-check"></span>
                                @else
                                    <span class="am-icon-close"></span>
                                @endif
                            </td>
                            <td class="am-hide-sm-only">
                                @if($good->best)
                                    <span class="am-icon-check"></span>
                                @else
                                    <span class="am-icon-close"></span>
                                @endif
                            </td>
                            <td class="am-hide-sm-only">
                                @if($good->new)
                                    <span class="am-icon-check"></span>
                                @else
                                    <span class="am-icon-close"></span>
                                @endif
                            </td>
                            <td class="am-hide-sm-only">
                                @if($good->hot)
                                    <span class="am-icon-check"></span>
                                @else
                                    <span class="am-icon-close"></span>
                                @endif
                            </td>
{{--                            <td>{{ $good->sort_order }}</td>--}}
                            <td>{{ $good->number }}</td>

                            <td>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <a class="am-btn am-btn-default am-btn-xs am-text-secondary" href="{{ route('admin.good.edit', $good->id) }}">
                                            <span class="am-icon-pencil-square-o"></span> 编辑
                                        </a>
                                        <a class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" href="{{ route('admin.good.destroy', $good->id) }}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="确定删除吗？">
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
