<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{

    public function __construct()
    {
        view()->share(['_order' => 'am-active']);
    }
    public function index()
    {
        $orders = Order::with('address')->orderBy('created_at', 'desc')->paginate(config('wfhshop.page_size'));
        $order_status = config('wfhshop.order_status');
        return view('admin.order.index', ['orders' => $orders, 'order_status' => $order_status]);
    }

    public function edit($id)
    {
        $order = Order::with('address', 'express', 'user', 'order_goods.good')->find($id);
        return view('admin.order.edit', ['order' => $order]);
    }

    public function update(Request $request, $id)
    {
        $order = order::find($id);
        $order->express_code = $request->express_code;
        //只有当前在未发货状态下，才修改订单状态
        if ($order->status == 1) {
            $order->status = 2;
        }
        $order->save();
        return back()->with('info', '发货成功');
    }

    //根据订单状态显示
    public function show($id)
    {
        $orders = Order::with('address')->where('status',$id)->orderBy('created_at', 'desc')->paginate(config('wfhshop.page_size'));
        $order_status = config('wfhshop.order_status');
        return view('admin.order.show', ['orders' => $orders,'id'=>$id, 'order_status' => $order_status]);
    }
}
