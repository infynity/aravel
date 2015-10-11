@extends('layouts.admin')
@section('content')
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf">
                <strong class="am-text-primary am-text-lg">订单管理</strong> /
                <small>订单详情</small>
            </div>
        </div>

        @include('layouts._message')

        <div class="am-g">
            <div class="am-u-sm-12">
                <div class="am-panel am-panel-default">
                    <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">
                        基本信息<span class="am-icon-chevron-down am-fr"></span></div>
                    <div class="am-panel-bd am-collapse am-in" id="collapse-panel-1">


                        <table class="am-table am-table-bd am-table-bordered am-table-striped admin-content-table">

                            <tbody>
                            <tr>
                                <td>订单号</td>
                                <td>{{ $order->id }}</td>
                                <td>订单状态</td>
                                <td>{{ order_status($order->status) }}</td>
                            </tr>
                            <tr>
                                <td>购货人</td>
                                <td>{{ $order->user->nickname }}/{{ $order->user->openid }}</td>
                                <td>下单时间</td>
                                <td>{{ $order->created_at }}</td>
                            </tr>
                            <tr>
                                <td>支付方式</td>
                                <td>
                                    {{$order->status == 0 ? '未支付' : '微信支付'}}
                                </td>
                                <td>付款时间</td>
                                <td>{{ $order->pay_time }}</td>
                            </tr>
                            <tr>
                                <td>配送方式</td>
                                <td>{{ $order->express->name}}</td>
                                <td>发货时间</td>
                                <td>{{ $order->shipping_time }}</td>
                            </tr>
                            <tr>
                                <td>发货单号</td>
                                <td colspan="3">
                                    <form action="{{route('admin.order.update', $order->id)}}" method="post">
                                        {!! csrf_field() !!}
                                        {!! method_field('put') !!}
                                        <input type="text" class="am-input-sm" name="express_code" value="{{ $order->express_code }}">
                                        <button type="submit" class="am-btn am-btn-primary am-btn-xs" id="send">
                                            {{$order->status==1 ? '发货' : '修改发货单号'}}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="am-panel am-panel-default">
                    <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">
                        收货人信息<span class="am-icon-chevron-down am-fr"></span></div>
                    <div class="am-panel-bd am-collapse am-in" id="collapse-panel-2">


                        <table class="am-table am-table-bd am-table-bordered am-table-striped admin-content-table">

                            <tbody>
                            <tr>
                                <td>收货人</td>
                                <td>{{ $order->address->name }}</td>
                                <td>电话</td>
                                <td><a href="tel:{{ $order->address->tel }}">{{ $order->address->tel }}</a></td>
                            </tr>
                            <tr>
                                <td>地址</td>
                                <td colspan="3">{{ $order->address->address }}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="am-panel am-panel-default">
                    <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-3'}">
                        商品信息<span class="am-icon-chevron-down am-fr"></span></div>
                    <div class="am-panel-bd am-collapse am-in" id="collapse-panel-3">

                        <table class="am-table am-table-bd am-table-bordered am-table-striped admin-content-table">
                            <thead>
                            <tr>
                                <th>商品名称</th>
                                <th>单价</th>
                                <th>数量</th>
                                <th>属性</th>
                                <th>小计</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->order_goods as $g)
                                <tr>
                                    <td>{{$g->good->name}}</td>
                                    <td>{{$g->good->price}}</td>
                                    <td>{{$g->number}}</td>
                                    <td>{{$g->attr}}</td>
                                    <td>￥{{number_format(($g->good->price * $g->number), 2)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="am-panel am-panel-default">
                    <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-3'}">
                        费用信息<span class="am-icon-chevron-down am-fr"></span></div>
                    <div class="am-panel-bd am-collapse am-in" id="collapse-panel-3">

                        <table class="am-table am-table-bd am-table-bordered am-table-striped admin-content-table">
                            <thead>
                            <tr>
                                <th>商品总金额</th>
                                <th>配送费</th>
                                <th>合计</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>￥{{number_format(($order->total_price - $order->express_money), 2)}}</td>
                                    <td>￥{{$order->express_money}}</td>
                                    <td>￥{{$order->total_price}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($order->status >= 2)
                    <div class="am-panel am-panel-default">
                        <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-4'}">
                            物流信息<span class="am-icon-chevron-down am-fr"></span></div>
                        <div class="am-panel-bd am-collapse am-in" id="collapse-panel-4">
                            <iframe src="http://m.kuaidi100.com/index_all.html?type={{ $order->express->key}}&postid={{ $order->express_code}}" frameborder="0" width="100%" height="500"></iframe>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
@stop


@section('js')
@stop
