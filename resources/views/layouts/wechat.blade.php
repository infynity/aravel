<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>infynity's商城</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('amaze/css/amazeui.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('amaze/css/app.css') }}"/>
    <link rel='stylesheet' href='{{ asset('NProgress/nprogress.css') }}'/>
    <style>
        .am-tabs-d2 .am-tabs-nav>.am-active:after{
            border-bottom-color: #6f5499;
        }
        .am-tabs-d2 .am-tabs-nav>.am-active{
            border-bottom: 2px solid #6f5499;
        }
        .am-navbar-default .am-navbar-nav {
            background-color: #6f5499;
            background-image: linear-gradient(to bottom, #563d7c 0, #6f5499 100%);
            background-repeat: repeat-x;
            opacity: .9;
        }
        .am-tabs-d2 .am-tabs-nav>.am-active a{
            color: #563d7c;
        }

        .flash_img {
            height: 200px;
        }

        .good_img{
            height: 260px;
        }
        .am-slider-c1 .am-control-nav li a.am-active {
            background: red;
        }
        [data-am-widget=tabs] {
            margin: 0px;
        }
        .am-tabs-bd{
            border: 0;
        }




    </style>
    @yield('css')
</head>
<body>


<!-- content start -->
@yield('content')
<!-- content end -->

<!-- Navbar -->
<div data-am-widget="navbar" class="am-navbar am-cf am-navbar-default "  id="">
    <ul class="am-navbar-nav am-cf am-avg-sm-4" style="background: #c0c0c0;">
        <li>
            <a href="/">
                <span class="am-icon-home"></span>
                <span class="am-navbar-label">首页</span>
            </a>
        </li>


        <li>
            {{--<a href="#sidebar" data-am-offcanvas="{target: '#sidebar', effect: 'push'}">--}}
            <a href="/category">
                <span class="am-icon-th-list"></span>
                <span class="am-navbar-label">分类</span>
            </a>
        </li>
         <li>
                 <a href="/cart">
                     <span class="am-icon-shopping-cart" style="display:inline-block;"></span>
                     <span class="am-badge am-badge-secondary am-round" id="cart_number">{{$cart_number}}</span>
                     <span class="am-navbar-label">购物车 </span>
                 </a>
             </li>
        <li>
            <a href="/account">
                <span class="am-icon-user"></span>
                <span class="am-navbar-label">我的</span>
            </a>
        </li>
    </ul>
</div>


<div data-am-widget="gotop" class="am-gotop am-gotop-fixed" style="width: auto;">
    <a href="#top" title="回到顶部" class="am-icon-btn am-icon-arrow-up am-active" id="amz-go-top"></a>
</div>


<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="amaze/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="{{ asset('amaze/js/jquery.min.js') }}"></script>
<!--<![endif]-->
<script src="{{ asset('amaze/js/amazeui.min.js') }}"></script>
<script src="{{ asset('js/laravel.js') }}"></script>
<script src="{{ asset('NProgress/nprogress.js') }}"></script>
<script src="{{ asset('js/fastclick.js') }}"></script>
<script>
    $(function () {
        FastClick.attach(document.body);
    });

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
