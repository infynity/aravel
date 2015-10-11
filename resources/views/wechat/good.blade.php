@extends('layouts.wechat')
@section('css')
    <style>
        .am-titlebar-multi {
            border-top: none;
        }

        .am-titlebar {
            margin-top: 0;
        }

        #price {
            color: #f24b48;
        }

        .am-titlebar-multi .am-titlebar-title {
            color: #252525;
            font-weight: normal;
        }

        .am-titlebar-multi a {
            color: #6f5499;
        }

        .am-tabs-bd .am-tab-panel {
            padding: 0;
        }

        .p_10 {
            padding: 0 10px;
        }

        .pinglun{
            background: #add8e6;
        }
        .desc img{
             width:100%;
        }

        .option .btn-del {
                    background-position: 10px -20px;
        }

        .btn-add, .btn-del {
            overflow: hidden;
            text-indent: -200px;
            background: url({{asset('img/shp-cart-icon-sprites.png')}}) no-repeat -15px -20px;
            background-size: 50px 100px;
        }

        .btn-add, .btn-del, .fm-txt {
            border: solid #ccc;
            float: left;
            width: 32px;
            height: 24px;
            line-height: 24px;
            text-align: center;
        }

        .btn-del {
            border-width: 1px 0 1px 1px;
            border-radius: 3px 0 0 3px;
            font-size: 20px;
        }

        .btn-add {
            border-width: 1px 1px 1px 0;
            border-radius: 0 3px 3px 0;
            font-size: 20px;
        }

        .fm-txt {
            border-width: 1px;
            font-size: 16px;
            border-radius: 0;
            -webkit-appearance: none;
            backgroumd-color: #fff;
        }

        .select {
            position: relative;
            top: -48px;
            left: 80px;
        }

    </style>
@stop
@section('content')
    <div data-am-widget="tabs" class="am-tabs am-tabs-d2" data-am-tabs-noswipe="1">
        <ul class="am-tabs-nav am-cf">
            <li class="am-active"><a href="[data-tab-panel-0]">商品</a></li>
            <li class=""><a href="[data-tab-panel-1]">详情</a></li>
            <li class=""><a href="[data-tab-panel-2]">评价</a></li>
        </ul>
        <div class="am-tabs-bd">
            <div data-tab-panel-0 class="am-tab-panel am-active">

                <div data-am-widget="slider" class="am-slider am-slider-a1" data-am-slider='{"directionNav":false}'>
                    <ul class="am-slides">
                        @foreach($good->good_galleries as $g)
                            <li><img src="{{$g->img}}" class="good_img"></li>
                        @endforeach

                    </ul>
                </div>


                <div data-am-widget="titlebar" class="am-titlebar am-titlebar-multi">
                    <h2 class="am-titlebar-title" id="price">
                        ￥{{number_format($good->price, 2)}}
                    </h2>
                </div>

                <div data-am-widget="titlebar" class="am-titlebar am-titlebar-multi" id="info">
                    <h2 class="am-titlebar-title ">
                        {{$good->name}}
                    </h2>

                    <nav class="am-titlebar-nav">
                      简介  <a href="#more">&raquo;</a>
                    </nav>
                </div>

                <div data-am-widget="titlebar" class="am-titlebar am-titlebar-multi">
                    <h2 class="am-titlebar-title">
                        库存：<span id="number">{{$good->number}}</span>
                    </h2>
                </div>

                <div data-am-widget="titlebar" class="am-titlebar am-titlebar-multi">
                    <h2 class="am-titlebar-title">

                        数量：
                        <section class="select">
                            <p class="option">
                                <a class="btn-del" id="minus" onclick="minus();">-</a>
                                <input type="text" class="fm-txt" value="1" id="num" onblur="modify();">
                                <a class="btn-add" id="plus" onclick="plus();">+</a>
                            </p>
                        </section>
                    </h2>

                </div>

                <hr data-am-widget="divider" style="" class="am-divider am-divider-default"/>
                <div style="padding:0 10px 10px;">
                    <button type="button" class="am-btn am-btn-lg am-btn-success am-radius am-btn-block" id="add_cart">
                        <i class="am-icon-shopping-cart"></i>
                        加入购物车
                    </button>
                </div>
            </div>
            <div data-tab-panel-1 class="am-tab-panel ">
                <div class="p_10 desc">
                    {!! $good->desc !!}
                </div>
            </div>
            <div data-tab-panel-2 class="am-tab-panel ">
                <div class="p_10">
                    <ul class="am-comments-list am-comments-list-flip">

                        @foreach($good->comments as $comment)
                            <article class="am-comment">
                                <a href="#link-to-user-home">
                                    <img src="{{$comment->user->headimgurl}}" alt="" class="am-comment-avatar"
                                         width="48" height="48"/>
                                </a>

                                <div class="am-comment-main">
                                    <header class="am-comment-hd">
                                        <!--<h3 class="am-comment-title">评论标题</h3>-->
                                        <div class="am-comment-meta">
                                            <a href="#link-to-user"
                                               class="am-comment-author">{{$comment->user->nickname}}</a>
                                            于 {{$comment->created_at}} 对 {{$good->name}} 发表评论
                                        </div>
                                    </header>

                                    <div class="am-comment-bd">
                                        {{$comment->content}}
                                    </div>
                                </div>
                            </article>
                             @if($comment->reply)
                                <article class="am-comment am-comment-flip am-comment-success">
                                    <a href="javascript:void(0);" target="_blank">
                                        <img src="{{$comment->admin->headimg}}" alt="" class="am-comment-avatar" width="48" height="48"/>
                                    </a>

                                    <div class="am-comment-main">
                                        <header class="am-comment-hd">
                                            <!--<h3 class="am-comment-title">评论标题</h3>-->
                                            <div class="am-comment-meta  pinglun">
                                                <a href="javascript:void(0);" class="am-comment-author">管理员{{$comment->admin->name}}</a>
                                                于 {{$comment->updated_at}} 对 {{$comment->user->nickname}} 发表评论
                                            </div>
                                        </header>

                                        <div class="am-comment-bd">
                                            {{$comment->reply}}
                                        </div>
                                    </div>
                                </article>
                           @endif
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="am-modal am-modal-alert" tabindex="-1" id="cart_msg">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">提示信息</div>
            <div class="am-modal-bd msg">
                恭喜，已添至购物车~
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn">确定</span>
            </div>
        </div>
    </div>

@stop

@section('js')

      <script>

          var num = $("#num");
          function minus() {
              if (num.val() != 1) {
                  var number = parseInt(num.val()) - 1;
                  num.val(number);
              }
          }

          function modify() {
              if (parseInt(num.val()) < 1) {
                  num.val(1);
              }
              num.val(parseInt(num.val()));
          }

          function plus() {
              var number = parseInt(num.val()) + 1;
              num.val(number);
          }

          $(function () {
              $('#info').click(function () {
                  $(".am-tabs").tabs('open', 1);
              })

             //增加到购物车
            $("#add_cart").click(function () {
                //库存
                var number = parseInt($("#number").text());
                //用户购买数量
                var num = parseInt($("#num").val());

                if (number == 0) {
                     $(".msg").html('缺货！不能购买！');
                     $('#cart_msg').modal();
                    return;
                }
                var data = {
                    num: num,
                    good_id: {{$good->id}}
                }

                //联动添加到购物车的商品数量
                $.post('/cart', data, function (data) {
                    console.log(data);
                    $(".msg").html(data.info);
                    $('#cart_msg').modal();

                    if (data.status == 1) {
                        $("#cart_number").text(data.cart_number);

                        setTimeout(function () {
                            $('#cart_msg').modal('close');
                        }, 600)
                    }

                }, "json");
                return false;
              })

          })
      </script>
@stop

