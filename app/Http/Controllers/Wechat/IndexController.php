<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cache;
use App\Models\Category;
use App\Models\Good;
use App\Models\User;
use App\Models\Good_gallery;
use Overtrue\Wechat\Auth;
use App\Models\Cart;
use App\Models\Address;
use App\Models\Order;
use App\Models\Order_good;
use App\Models\Comment;
use Session;


class IndexController extends Controller
{

    private $app_id;
    private $secret;
    private $user;

    public function __construct()
    {
        $this->app_id = config('wechat.app_id');
        $this->secret = config('wechat.secret');
        $this->check_login();
        //手动加Session
        //$user = User::where('id',30)->get();
        //Session::put('user', $user);
        $users = Session::get('user');
        $this->user = $users[0];
        //初始化用户购物车的数量
        view()->share(['cart_number' => $this->cart_number()]);
    }

    //获取用户信息
    private function check_login()
    {
        //如果session中没有用户信息
        if (!Session::has('user')) {

            //获取用户信息
            $auth = new Auth($this->app_id, $this->secret);
            $user_info = $auth->authorize($to = null, $scope = 'snsapi_userinfo', $state = 'STATE');

            $check = User::where("openid", $user_info->openid)->get();

            //如果数据库没有用户记录，存入数据库
            if ($check->count() == 0) {

                $user = User::create([
                    'openid' => $user_info->openid,
                    'sex' => $user_info->sex,
                    'nickname' => $user_info->nickname,
                    'city' => $user_info->city,
                    'province' => $user_info->province,
                    'headimgurl' => $user_info->headimgurl
                ]);

            } else {
                //如果数据库中已经有了当前用户
                $user = $check;
            }

            //用户信息存入session，并跳转到微商城首页
            Session::put('user', $user);
            return back();
        }
    }

    //统计用户购物车商品数量
    private function cart_number()
    {
        return Cart::where('user_id', $this->user->id)->sum('num');
    }

    //获取栏目信息
    private function get_categories()
    {
        $categories = Cache::rememberForever('wechat_index_categories_wfh', function () {
            $categories = Category::with('children')->where('parent_id', '0')->orderBy('parent_id', 'asc')->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get();
            return $categories;
        });
        return $categories;
    }

    public function index()
    {
        $best_goods = Good::where('best', true)->orderBy('created_at', 'desc')->take(4)->get();
        $hot_goods = Good::where('hot', true)->orderBy('created_at', 'desc')->take(4)->get();
        $new_goods = Good::where('new', true)->orderBy('created_at', 'desc')->take(4)->get();
        return view('wechat.index', ['best_goods' => $best_goods, 'hot_goods' => $hot_goods, 'new_goods' => $new_goods]);
    }

    public function category()
    {
        return view('wechat.category', ['categories' => $this->get_categories()]);
    }

    public function good_list($category_id)
    {
        $category = Category::find($category_id);
        $goods = Good::where('onsale', true)->where('category_id', $category_id)->orderBy('created_at', 'desc')->get();
        return view('wechat.good_list', ['category' => $category, 'goods' => $goods]);
    }

    public function good($good_id)
    {

        $good = Good::with('good_galleries', 'comments.admin')->find($good_id);
        return view('wechat.good', ['good' => $good]);

    }

    //添加商品到购物车，库存逻辑
    public function add_cart(Request $request)
    {
        //判断购物车，当前商品是否有记录
        $cart = Cart::where('good_id', $request->good_id)->where('user_id', $this->user->id)->first();

        //当前商品库存数
        $number = Good::find($request->good_id)->number;

        //如果是初次新增到购物车
        if (!$cart) {
            //如果用户提交数大于库存数，提示商品库存不足
            if ($request->num > $number) {
                return response()->json(['status' => 0, 'info' => '购买量不能超过库存总数']);
            }

            Cart::create(['good_id' => $request->good_id, 'user_id' => $this->user->id, 'num' => $request->num]);
            return response()->json(['status' => 1, 'info' => '恭喜，已添至购物车~', 'cart_number' => $this->cart_number()]);
        }

        //如果购物车已经有该商品的记录
        //购物车里的数量+用户新提交的数量 > 库存数
        $new_num = $cart->num + $request->num;
        if ($new_num > $number) {
            return response()->json(['status' => 0, 'info' => '购物车中该商品数量已超过库存']);
        }

        $cart->num = $new_num;
        $cart->save();

        return response()->json(['status' => 1, 'info' => '恭喜，已添至购物车~', 'cart_number' => $this->cart_number(), 'total_price' => number_format($this->total_price(), 2)]);
    }

    //购物车
    public function cart()
    {
        $carts = Cart::with('good')->where('user_id', $this->user->id)->get();
        return view('wechat.cart', ['carts' => $carts, 'total_price' => $this->total_price()]);
    }

    //计算总价
    private function total_price()
    {
        $total_price = 0;
        $carts = Cart::with('good')->where('user_id', $this->user->id)->get();
        foreach ($carts as $cart) {
            $total_price += $cart->num * $cart->good->price;
        }
        return $total_price;
    }

    //我的账户
    public function account()
    {

        $orders=Order::with('order_goods.good')->where('user_id',$this->user->id)->where('status',0)->orderby('created_at','desc')->get();
        $wpay=$orders->count();
        return view('wechat.account', ['headimg' => $this->user->headimgurl, 'user_id' => $this->user->id,'wpay'=>$wpay]);
    }

    //地址管理
    public function address($id)
    {
        $addresses = Address::where('user_id', $id)->get();
        if ($addresses->count() != 0) {
            return view('wechat.address', ['address_id' => $addresses[0]->id, 'user_id' => $this->user->id, 'addresses' => $addresses]);
        } else {
            return view('wechat.address_up', ['user_id' => $this->user->id]);
        }
    }

    //首次添加地址
    public function add_addr(Request $request)
    {
        Address::create($request->all());
        return redirect('/account');

    }

    //更新地址
    public function addr_up(Request $request, $id)
    {
        $address = Address::find($id);
        $address->update($request->all());
        return redirect('/account');
    }

    //我的信息
    public function user_info($id)
    {
        $orders=Order::where('user_id', $id)->orderBy('created_at','desc')->get();
        $address = Address::where('user_id', $id)->first();
        return view('wechat.user_info', ['orders'=>$orders,'user_info' => $this->user, 'address' => $address]);
    }

    /***
     * 购物车删除
     */
    public function del(Request $request)
    {
        if(Cart::destroy($request->id)){
            return response()->json(['status' => 1, 'total_price' => $this->total_price(), 'cart_number' => $this->cart_number()]);
        }else{
            return response()->json(['status' => 2, 'total_price' => $this->total_price(), 'cart_number' => $this->cart_number()]);
        }
    }

    /**
     * 结算，生成订单，删除购物车
     */
    public function setorder()
    {
        $address=Address::where('user_id',$this->user->id)->first();
        if($address){

        $carts=Cart::with('good')->where('user_id',$this->user->id)->get();
        $order= new Order;
        $order->user_id=$this->user->id;
        $order->status=0;
        $order->address_id=$address->id;
        $order->express_id=1;
        $order->express_code=918682605098;
        $order->total_price=$this->total_price();
        $order->save();

        foreach ($carts as $cart){
            $order_good=new Order_good;
            $order_good->good_id=$cart->good_id;
            $order_good->order_id=$order->id;
            $order_good->number=$cart->num;
            $order_good->save();
        }

        $carts = Cart::where('user_id',$this->user->id)->delete();
        $order_goods=Order_good::with('good')->where('order_id',$order->id)->get();
        return view('wechat.setorder',['address'=>$address, 'carts' => $order_goods,'total_price' =>  $order->total_price,'cart_number'=>0,'user_id'=>$this->user->id]);
        }else{
            return redirect(url('/address', $this->user->id));
        }
    }

    //全部订单信息
    public function getorder()
    {
        $orders=Order::with('order_goods.good')->where('user_id',$this->user->id)->orderby('created_at','desc')->get();
        return view('wechat.getorder',['orders'=>$orders]);

    }

    //待付款订单信息
    public function waitpayorder()
    {

        $orders=Order::with('order_goods.good')->where('user_id',$this->user->id)->where('status',0)->orderby('created_at','desc')->get();
        return view('wechat.getorder',['orders'=>$orders]);
    }

    //根据id获得订单
    private function getoneorder($id)
    {
       $order=Order::with('order_goods.good','express')->find($id);
        return $order;
    }

    //到一条订单详情中去
    public function oneorder($id)
    {
        $address=Address::where('user_id',$this->user->id)->first();
       $order=$this->getoneorder($id);
        return view('wechat.oneorder',['order'=>$order,'address'=>$address]);

    }

    //支付完成
    public function pay($id)
    {    $address=Address::where('user_id',$this->user->id)->first();
        $order=$this->getoneorder($id);
        $order->status=1;
        $order->save();
        return view('wechat.oneorder',['order'=>$order,'address'=>$address]);
    }

    //发货
    public function send($id)
    {
        $address=Address::where('user_id',$this->user->id)->first();
        $order=$this->getoneorder($id);
        $order=$this->getoneorder($id);
        $order->status=2;
        $order->save();
        return view('wechat.oneorder',['order'=>$order,'address'=>$address]);
    }

    //确认收货
    public function getbag($id)
    {
        $order=$this->getoneorder($id);
        $order->status=3;
        $order->save();
        return view('wechat.comment',['goods'=>$order->order_goods]);

    }

    //post评论订单
    public function comment(Request $request)
    {
        //如果没有评论则跳过该条
        if($request->contents){
            foreach ($request->contents as $k => $v) {
                if($v!=''){
                    $comment = new Comment;
                    $comment->user_id = $this->user->id;
                    $comment->good_id = $request->gid["$k"];
                    $comment->is_show=1;
                    $comment->order_id=$request->order_id;
                    $comment->content=$v;
                    $comment->save();
                }

            }
        }
        $order=Order::with('order_goods.good','comments')->find($request->order_id);
       return view('wechat.comment_done',['order_goods'=>$order->order_goods,'comments'=>$order->comments]);
    }

    //评论完成跳转完成页
    public function getmycom($id){
        $order=Order::with('order_goods.good','comments')->find($id);
        return view('wechat.comment_done',['order_goods'=>$order->order_goods,'comments'=>$order->comments]);

    }
}
