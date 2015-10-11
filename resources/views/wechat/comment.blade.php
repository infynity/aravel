@extends('layouts.wechat')
@section('css')
    <style>
    .am-panel-bd {
       padding: 0;
       position: relative;
    }
    .am-panel-bd img{
        /*width:100%;*/
    }
    .am-panel {
        border:0;
    }
    .head{
     position: absolute;
     left:25%;
     top:50%;
     margin-top:-60px;
     margin-left:-60px;
    }
    .am-list-news-default .am-list-item-thumb-bottom-left .am-list-thumb, .am-list-news-default .am-list-item-thumb-bottom-right .am-list-thumb {
    max-height: 120px;
    overflow: hidden;
    }
    .am-list-item-text{
        font-size: 19px;
        text-align: right;
    }
    </style>
    @stop
@section('content')
<header data-am-widget="header" class="am-header am-header-default" style="background: orangered">
           <div class="am-header-left am-header-nav">

           </div>

           <h1 class="am-header-title">
             商品评论
           </h1>

           <div class="am-header-right am-header-nav">

           </div>
       </header>
<form action="/comment" method="post">
          {!! csrf_field() !!}

 @foreach($goods as $good)
<div class="am-panel am-panel-default">
  <div class="am-panel-hd">{{$good->good->name}}</div>

  <div class="am-panel-bd">
     <ul data-am-widget="gallery" class="am-gallery am-avg-sm-3 am-avg-md-3 am-avg-lg-4 am-gallery-default"  >
          <li>
            <div class="am-gallery-item">
                {{--<a href="http://s.amazeui.org/media/i/demos/bing-1.jpg" class="">--}}
                  <img src="{{$good->good->thumb}}"  alt="远方 有一个地方 那里种有我们的梦想"/>
                    <h3 class="am-gallery-title"></h3>

                {{--</a>--}}
            </div>
          </li>

      </ul>
  </div>
      <footer class="am-panel-footer">
        <div class="am-input-group am-input-group-lg">
          <span class="am-input-group-label">@</span>
          <input type="text" class="am-form-field" placeholder="简单点评下吧~" name="contents[]">
          <input type="hidden" name="gid[]" value="{{$good->good->id}}">
          <input type="hidden" name="order_id" value="{{$good->order_id}}">
        </div>
      </footer>
</div>
  @endforeach
          <div style="padding:0 10px 10px;">

              <button type="submit" class="am-btn am-btn-lg am-btn-warning am-radius am-btn-block" id="add_cart">
                  <i class="am-icon-shopping-cart"></i>
                  发布评价
              </button>

          </div>
  </form>
@stop

