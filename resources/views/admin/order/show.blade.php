@extends('layouts.admin')
@section('content')
    <div class="admin-content">
        <div class="am-cf am-padding">
            <div class="am-fl am-cf">
                <strong class="am-text-primary am-text-lg">订单管理</strong> /
                <small>订单列表</small>
            </div>
        </div>

        @include('layouts._message')

        <div class="am-g">

            <div class="am-u-sm-12 am-u-md-3">
                <div class="am-form-group">
                    <select data-am-selected="{btnSize: 'sm'}" id="change_type">
                        <option value="">请选择</option>

                        @foreach($order_status as $k=>$v)
                            {{--<option value="{{ $k }}">{{ $v }}</option>--}}
                              <option value="{{ $k }}"
                            @if($k == $id)
                            selected @endif>
                            {{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div>



        </div>

        <div class="am-g">
            <div class="am-u-sm-12">
                <form class="am-form">
                    <table class="am-table am-table-striped am-table-hover table-main">
                        <thead>
                        <tr>
                            <th>订单号</th>
                            <th>下单时间</th>
                            <th>收货人</th>
                            <th>总金额</th>
                            <th>订单状态</th>
                            <th class="table-set">操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->address->name }}
                                    [<a href="tel:{{ $order->address->tel }}">{{ $order->address->tel }}</a>]<br>{{ $order->address->address }}
                                </td>
                                <td>￥{{ number_format($order->total_price, 2) }}</td>
                                <td>{{order_status($order->status)}}</td>
                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a class="am-btn am-btn-default am-btn-xs am-text-secondary" href="{{ route('admin.order.edit', $order->id) }}">
                                                <span class="am-icon-list-alt"></span> 查看
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

                            {!! $orders->render() !!}
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
@stop

@section('js')
    <script type="text/javascript">
    //根据status显示订单
        $("#change_type").change(function(){
            var status = $(this).val();
            var url = '/admin/order/'+status;
            location.href = url;
        })
    </script>
@stop
