<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
class UserController extends Controller
{

    public function __construct()
    {
        view()->share(['_user' => 'am-active']);
    }

    public function index()
    {
        $users = User::orderBy('created_at')->paginate(config('wfhshop.page_size'));
        return view('admin.user.index', ['users' => $users]);
    }

    //根据User_id查看User订单
    public function edit($id)
    {
        $orders = Order::with('address')->where('user_id',$id)->paginate(config('wfhshop.page_size'));
        $order_status = config('wfhshop.order_status');
        return view('admin.order.index', ['orders' => $orders, 'order_status' => $order_status]);

    }

}
