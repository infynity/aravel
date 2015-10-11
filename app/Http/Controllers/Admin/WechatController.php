<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cache;

use Overtrue\Wechat\Menu;
use Overtrue\Wechat\MenuItem;
use Overtrue\Wechat\User;

class WechatController extends Controller
{
    private $app_id;
    private $secret;

    public function __construct()
    {
        view()->share('_wechat', 'am-in');
        $this->app_id = config('wechat.app_id');
        $this->secret = config('wechat.secret');
    }

    //获取菜单
    public function get_menu()
    {
        $menus = Cache::rememberForever('admin_wechat_menus_wfh', function () {
            $menu = new Menu($this->app_id, $this->secret);
            return $menu->get();
        });
        return view('admin.wechat.menu', ["menus" => $menus, '_get_menu' => 'am-active']);
    }


    //设置菜单
    public function set_menu(Request $request)
    {
        // $menus = $request->menus;
        // dd( $menus[0]);
        $menu = new Menu($this->app_id, $this->secret);
        $menus = $request->menus; // menus 是后台管理中心表单post过来的一个数组
        $target = [];

        // 构建菜单
        foreach ($menus as $m) {
            // 创建一个菜单项
            $item = new MenuItem($m['name'], $m['type'], $m['key']);
            // 子菜单
            if (!empty($m['buttons'])) {
                $buttons = [];
                foreach ($m['buttons'] as $button) {
                    if ($button['name'] != '') {
                        $buttons[] = new MenuItem($button['name'], $button['type'], $button['key']);
                    }
                }
                $item->buttons($buttons);
            }
            $target[] = $item;
        }
        // dd($target);
        $menu->set($target); // 失败会抛出异常
        Cache::forget('admin_wechat_menus_wfh');
        return back()->with('info', '您已成功设置菜单，请取消关注后，再重新关注~');;
    }



    function api_config()
    {
        $path = getcwd() . '/../config/wechat.php';
        $config = file_get_contents($path);
        return view('admin.wechat.api_config', ['config' => $config, '_api_config' => 'am-active']);
    }

    function set_config(Request $request)
    {
        $path = getcwd() . '/../config/wechat.php';
        file_put_contents($path, $request->config);
        return back()->with('info', '编辑配置成功');
    }
}