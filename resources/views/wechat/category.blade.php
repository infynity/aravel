@extends('layouts.wechat')
@section('content')
<header data-am-widget="header" class="am-header am-header-default" style="background: orangered">
      <div class="am-header-left am-header-nav">

      </div>

      <h1 class="am-header-title">
         商品分类
      </h1>

      <div class="am-header-right am-header-nav">

      </div>
  </header>
    <nav data-am-widget="menu" class="am-menu  am-menu-stack">
        <a href="javascript: void(0)" class="am-menu-toggle">
            <i class="am-menu-toggle-icon am-icon-bars"></i>
        </a>


        <ul class="am-menu-nav am-avg-sm-1">
            @foreach($categories as $category)
                <li class="am-parent">
                    <a href="javascript:void 0;" class="">{{$category->name}}</a>
                    <ul class="am-menu-sub am-collapse">
                        @foreach($category->children as $c)
                            <li class="">
                                <a href="{{url('category', [$c->id])}}" class="">{{$c->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </nav>
@stop

