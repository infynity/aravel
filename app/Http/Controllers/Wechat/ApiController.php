<?php
namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Overtrue\Wechat\Server;
use Overtrue\Wechat\Message;
use App\Models\Good;

class ApiController extends Controller
{
    /**
     * 处理微信的请求消息
     */
    private $app_id;
    private $secret;

    public function __construct()
    {
        view()->share('_wechat', 'am-in');
        $this->app_id = config('wechat.app_id');
        $this->secret = config('wechat.secret');
    }

    public function serve(Server $server)
    {
        $server->on('event', function ($event) {
            switch ($event->Event) {
                case 'subscribe':
                    return Message::make('text')->content('您好！欢迎关注infynity的商城');

                    break;
                case 'CLICK':
                    switch ($event->EventKey) {
                        case 'best':
                            return $this->best();
                            break;
                        case 'hot':
                            return $this->hot();
                            break;
                        case 'new':
                            return $this->new_goods();
                            break;
                        case 'help':
                            return $this->help();
                            break;
                        case 'order':
                            return $this->order();
                            break;
                        case 'tel':
                            return $this->tel();
                            break;
                        case 'email':
                            return $this->email();
                            break;
                        default:
                            return $this->default_msg();
                            break;
                    }
                    break;
            }
        });
        //语音回复
        $server->on('message', 'voice', function ($message) {
            switch ($message->Recognition) {
                //人气商品
                case '人气商品！':
                    return $this->best();
                    break;

                //热门商品
                case '热门商品！':
                    return $this->hot();
                    break;

                case '最新商品！':
                    return $this->new_goods();
                    break;

                case '帮助！':
                    return $this->help();
                    break;

                default:
                    return $this->default_msg($message->Recognition);
                    break;
            }
        });
        $server->on('message', 'text', function ($message) {
            switch ($message->Content) {
                case 'best':
                    return $this->best();
                    break;
                case 'hot':
                    return $this->hot();
                    break;
                case 'new':
                    return $this->new_goods();
                    break;
                case 'help':
                    return $this->help();
                    break;
                case 'order':
                    return $this->order();
                    break;
                case 'tel':
                    return $this->tel();
                    break;
                case 'email':
                    return $this->email();
                    break;
                default:
                    return $this->default_msg();
                    break;
            }
        });
        // return Message::make('text')->content('我们已经收到您发送的图片！');
        return $server->serve(); // 或者 return $server;
    }

    //查询人气商品
    private function best()
    {
        $news = Message::make('news')->items(function () {
            $goods = Good::where('best', true)->get();
            $info = array();
            foreach ($goods as $good) {
                $info[] = Message::make('news_item')->title($good->name)->url(url('good', [$good->id]))->picUrl('http://wfhshop.whphp.com/' . $good->thumb);
            }
            return $info;
        });
        return $news;
    }

    //查询热门商品
    private function hot()
    {
        $news = Message::make('news')->items(function () {
            $goods = Good::where('hot', true)->get();
            $info = array();
            foreach ($goods as $good) {
                $info[] = Message::make('news_item')->title($good->name)->url(url('good', [$good->id]))->picUrl('http://wfhshop.whphp.com/' . $good->thumb);
            }
            return $info;
        });
        return $news;
    }

    //查询最新商品
    private function new_goods()
    {
        $news = Message::make('news')->items(function () {
            $goods = Good::where('new', true)->get();
            $info = array();
            foreach ($goods as $good) {
                $info[] = Message::make('news_item')->title($good->name)->url(url('good', [$good->id]))->picUrl('http://wfhshop.whphp.com/' . $good->thumb);
            }
            return $info;
        });
        return $news;
    }

    private function help()
    {
        $msg = "回复best，显示人气商品\n回复new，显示最新商品\n回复hot，显示热门商品\n也可以直接发语音命令如\n\"人气商品\"";
        return Message::make('text')->content($msg);
    }
    private function order()
    {
        $msg = "进入商城页面-我的-菜单项即可查看订单信息";
        return Message::make('text')->content($msg);
    }
    private function tel()
    {
        $msg = "133 4985 2478";
        return Message::make('text')->content($msg);
    }
    private function email()
    {
        $msg = "infynity@163.com\nor\n1278082436@qq.com";
        return Message::make('text')->content($msg);
    }
    //默认消息
    private function default_msg($msg = '默认消息(^_^)')
    {
        return Message::make('text')->content($msg);
    }
}