<!doctype html>
<html class="no-js fixed-layout">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>wfhshop商城管理系统</title>
  <meta name="description" content="这是一个 index 页面">
  <meta name="keywords" content="index">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="icon" type="image/png" href="{{ asset('amaze/i/favicon.png') }}">
  <link rel="apple-touch-icon-precomposed" href="{{ asset('amaze/i/app-icon72x72@2x.png') }}">
  <meta name="apple-mobile-web-app-title" content="Amaze UI" />
  <link rel="stylesheet" href="{{ asset('amaze/css/amazeui.min.css') }}"/>
  <link rel="stylesheet" href="{{ asset('amaze/css/admin.css') }}">
  <link rel="stylesheet" href="{{ asset('css/myshop.css') }}">
  <link rel='stylesheet' href='{{ asset('NProgress/nprogress.css') }}'/>


  @yield('css')

</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->

<header class="am-topbar admin-header">
  <div class="am-topbar-brand">
    <strong>wfhshop</strong> <small>商城管理系统</small>
  </div>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

    <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
      {{--<li><a href="javascript:;"><span class="am-icon-envelope-o"></span> 收件箱 <span class="am-badge am-badge-warning">5</span></a></li>--}}
      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
          <span class="am-icon-users"></span> 管理员：{{Auth::user()->name}} <span class="am-icon-caret-down"></span>
        </a>
        <ul class="am-dropdown-content">
          <li><a href="http://infy.whphp.com" target="_blank"><span class="am-icon-user"></span> 资料</a></li>
          <li><a href="/auth/logout"><span class="am-icon-power-off"></span> 退出</a></li>
        </ul>
      </li>
      <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
    </ul>
  </div>
</header>

<div class="am-cf admin-main">
  <!-- sidebar start -->
  <div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
    <div class="am-offcanvas-bar admin-offcanvas-bar">
      <ul class="am-list admin-sidebar-list">
        <li><a href="/admin"><span class="am-icon-home"></span> 首页</a></li>
        <li class="admin-parent">
          <a class="am-cf" data-am-collapse="{target: '#collapse-nav'}"><span class="am-icon-file"></span> 商品管理 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
          <ul class="am-list am-collapse admin-sidebar-sub {{ $_good or '' }}" id="collapse-nav">
            <li><a href="{{route('admin.good.index')}}" class="am-cf {{ $_goods or '' }}"><span class="am-icon-list"></span> 商品列表<span class="am-icon-star am-fr am-margin-right admin-icon-yellow"></span></a></li>
            <li><a href="{{route('admin.good.create')}}" class="am-cf {{ $_new_good or '' }}"><span class="am-icon-cart-plus"></span> 添加新商品</a></li>
            <li><a href="{{ route('admin.category.index') }}" class="am-cf {{ $_category or '' }}">
            <span class="am-icon-th"></span> 商品分类<span class="am-badge am-badge-secondary am-margin-right am-fr">24</span></a></li>
            <li><a href="{{ route('admin.comment.index') }}" class="{{ $_comment or '' }}"><span class="am-icon-comments-o"></span> 用户评论</a></li>
            <li><a href="/admin/brand/" class="{{ $_brand or '' }}"><span class="am-icon-apple"></span> 商品品牌</a></li>
            <li><a href="{{ route('admin.type.index') }}" class="{{ $_type or '' }}"><span class="am-icon-thumb-tack"></span> 商品类型</a></li>
            <li><a href="/admin/good/trash" class="am-cf {{ $_trash or '' }}"><span class="am-icon-trash"></span> 商品回收站</a></li>

          </ul>
        </li>

               <li class="admin-parent">
                            <a class="am-cf" data-am-collapse="{parent: '#menus', target: '#collapse-wechat'}">
                                <span class="am-icon-wechat"></span>
                                微信管理 <span class="am-icon-angle-right am-fr am-margin-right"></span>
                            </a>
                            <ul class="am-list am-collapse admin-sidebar-sub {{ $_wechat or '' }}" id="collapse-wechat">
                                <li>
                                    <a href="/admin/wechat/get_menu" class="am-cf {{ $_get_menu or '' }}">
                                        <span class="am-icon-list-ol"></span> 自定义菜单
                                    </a>
                                </li>
                                <li>
                                    <a href="/admin/wechat/api_config" class="am-cf {{ $_api_config or '' }}">
                                        <span class="am-icon-bullseye"></span> 接口配置
                                    </a>
                                </li>
                            </ul>
                        </li>
        <li> <a href="{{ route('admin.order.index') }}" class="{{ $_order or '' }}"><span class="am-icon-table"></span> 订单管理</a></li>
        <li><a href="{{ route('admin.user.index') }}" class="{{ $_user or '' }}"><span class="am-icon-pencil-square-o"></span> 会员管理</a></li>
        <li><a href="/auth/logout"><span class="am-icon-sign-out"></span> 注销</a></li>
      </ul>

      <div class="am-panel am-panel-default admin-sidebar-panel">
        <div class="am-panel-bd">
          <p><span class="am-icon-bookmark"></span> 你好！</p>
          <p>欢迎来到我的商城后台</p><a href="http://infy.whphp.com" target="_blank">前往我的个人页infy.whphp.com</a>
        </div>
      </div>


    </div>
  </div>
  <!-- sidebar end -->


  <!-- content start -->
  @yield('content')
  <!-- content end -->

</div>

<a href="#" class="am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}">
  <span class="am-icon-btn am-icon-th-list"></span>
</a>

<footer>
  <hr>
  <p class="am-padding-left">© Copyright 2015-20xx infynity版权所有</p>
</footer>

<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="amaze/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="{{ asset('amaze/js/jquery.min.js') }}"></script>
<!--<![endif]-->
<script src="{{ asset('amaze/js/amazeui.min.js') }}"></script>
<script src="{{ asset('amaze/js/app.js') }}"></script>
<script src="{{ asset('js/laravel.js') }}"></script>
<script src="{{ asset('NProgress/nprogress.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
     NProgress.start();
     NProgress.done();
</script>
@yield('js')
</body>
</html>
