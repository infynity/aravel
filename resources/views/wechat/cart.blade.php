@extends('layouts.wechat')
@section('css')
    <style>
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

        .trash {
            position: absolute;
            right: 20px;
            bottom: 3px;
        }

    </style>
@stop
@section('content')
<header data-am-widget="header" class="am-header am-header-default" style="background: orangered">
      <div class="am-header-left am-header-nav">

      </div>

      <h1 class="am-header-title">
         购物车
      </h1>

      <div class="am-header-right am-header-nav">

      </div>
  </header>
@if($carts->count()==0)
      <img src="{{ asset('img/20121228002349_L4tJu.thumb.700_0.jpg') }}" style="width: 100%;height:380px;" />
      <img src="{{ asset('img/2015-10-11_111749.jpg') }}" style="width: 100%;height:120px;" />

@else
    <div data-am-widget="list_news" class="am-list-news am-list-news-default">
        <div class="am-list-news-bd">
            <ul class="am-list">
            <form action="">

              {!! csrf_field() !!}
               {!! method_field('put') !!}
                @foreach($carts as $cart)

                        <!--缩略图在标题左边-->
                <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left">
                    <div class="am-u-sm-4 am-list-thumb">
                        <a href="{{url('good', [$cart->good->id])}}" class="">
                            <img src="{{$cart->good->thumb}}" alt="{{$cart->good->name}}"/>
                        </a>
                    </div>

                    <div class=" am-u-sm-8 am-list-main">
                        <h3 class="am-list-item-hd">
                            <a href="{{url('good', [$cart->good->id])}}" class="">{{$cart->good->name}}</a>
                        </h3>

                        <div class="am-list-item-text price">
{{--                            {{number_format($cart->good->price, 2)}}--}}
                                {{$cart->good->price}}

                        </div>

                        <div class="am-list-item-text sel " >
                            <section class="select">
                                <p class="option">
                                    <a class="btn-del" id="minus">-</a>
                                    <input type="hidden" value=" {{$cart->good->id}}" id="gid"/>
                                    <input type="hidden" value=" {{$cart->good->number}}" id="ventory"/>
                                    <input type="hidden" value=" {{$cart->user_id}}" id="uid"/>
                                    <input type="hidden" value=" {{$cart->id}}" id="cid"/>

                                    <input type="text" class="fm-txt" value="{{$cart->num}}" id="num" >
                                    <a class="btn-add" id="plus">+</a>
                                </p>
                            </section>
                            <span class="am-icon-trash am-icon-sm trash"></span>

                        </div>
                    </div>
                </li>
                @endforeach
 </form>
                <li class="am-g">
                    <a class="am-list-item-hd ">
                        {{--小计：￥{{number_format($total, 2)}}--}}
                        {{-- {{date('Y-d',time())}}--}}
                        小计：￥<span class="total_price">{{number_format($total_price, 2)}}</span>
                    </a>
                </li>
            </ul>
        </div>

        <div style="padding:0 10px 10px;">
        <a href="/setorder">
            <button type="button" class="am-btn am-btn-lg am-btn-danger am-radius am-btn-block" id="add_cart">
                <i class="am-icon-shopping-cart"></i>
                结算
            </button>
            </a>
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
        <div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">
          <div class="am-modal-dialog">
            <div class="am-modal-hd">Amaze UI</div>
            <div class="am-modal-bd">
              你，确定要删除这条记录吗？
            </div>
            <div class="am-modal-footer">
              <span class="am-modal-btn" data-am-modal-cancel>取消</span>
              <span class="am-modal-btn" data-am-modal-confirm>确定</span>
            </div>
          </div>
        </div>
@endif
@stop

@section('js')

    <script>
        //原始改变
     /*  $(function() {
            $('.trash').click(function(){
                    $(this).parents('li').remove();
            })
           var price;
           var total_price;
           var num;
            *//***
             * 减少数量价格联动
             *//*
           $(".btn-del").click(function(){
               if($(this).siblings("#num").val() !=1){
                   var number = parseInt($(this).siblings("#num").val()) - 1;
                   $(this).siblings("#num").val(number);
                   price=parseInt($(this).parents(".sel").siblings(".price").text());
                   total_price=parseInt($(".total_price").text())-price;
                   $(".total_price").text(total_price);
               }

           })
              *//***
                * 增加数量价格联动
                *//*
           $(".btn-add").click(function(){
               var number = parseInt($(this).siblings("#num").val()) + 1;
               $(this).siblings("#num").val(number);
               price=parseInt($(this).parents(".sel").siblings(".price").text());
               console.log(price);
               total_price=parseInt($(".total_price").text())+price;
               $(".total_price").text(total_price);
           })
            *//***
             * 手动改变数量时
             *//*
           $(".fm-txt").focus(function(){
               num=  parseInt($(this).val());
               console.log(num);
           });
           $(".fm-txt").blur(function(){
               var info;
               if (parseInt($(this).val()) < 1) {
                   $(this).val(1);
               }
               $(this).val(parseInt($(this).val()));
               price=parseInt($(this).parents(".sel").siblings(".price").text());
               info = (parseInt($(this).val())-num)*price;
               total_price=parseInt($(".total_price").text())+info;
               $(".total_price").text(total_price);
           })
        })*/


            /*amaze modal框问题
           $('#my-confirm').modal({
            relatedTarget: this,
            onConfirm: function(options) {
            var data = {
            id:id
                }
            $.post('/cart/del', data, function (data) {
            console.log(data);
            if(data.status==1){
            _d.remove();
            $("#cart_number").text(data.cart_number);
            $('.total_price').text(data.total_price);
                }
              })

            }
          });
            */

        $(function(){
        //删除购物车商品
         $('.trash').click(function(){
            var _d=$(this).parents('li');
            var id=$(this).siblings('.select').children('p').children('#cid').val();
            if(confirm('确认删除？ -------------------这里amaze模态框有缓存问题，暂时用下原生confirm()')){
             var data = {
            id:id
            }
            $.post('/cart/del', data, function (data) {
                console.log(data);
                if(data.status==1){
                _d.remove();
                  $("#cart_number").text(data.cart_number);
                   $('.total_price').text(data.total_price);
                }
              })

            }

         })

        $(".fm-txt").focus(function(){
                $(this).blur();
        })

        function pst(data){
          $.post('/cart', data, function (data) {
            console.log(data);
            if (data.status == 0) {
                $(".msg").html(data.info);
                $('#cart_msg').modal();
              }
            if (data.status == 1) {
                $("#cart_number").text(data.cart_number);
                $('.total_price').text(data.total_price);
                setTimeout(function () {
                    $('#cart_msg').modal('close');
                }, 600)
            }
          }, "json");
        }

        //增加数量
        $('.btn-add').click(function(){
            var good_id=$(this).siblings("#gid").val();
            var ventory=$(this).siblings("#ventory").val();
            var num = parseInt($(this).siblings("#num").val()) + 1;
                 if (num>ventory){
                 $(this).siblings("#num").val(ventory);
                 }else{
                  $(this).siblings("#num").val(num);
                 }
            var data = {
                num: 1,
                good_id: good_id
            }
             pst(data);
           })
        //减少数量联动
        $(".btn-del").click(function(){
            var good_id=$(this).siblings("#gid").val();
            var ventory=$(this).siblings("#ventory").val();
            var num = parseInt($(this).siblings("#num").val()) - 1;
                 if (num<0){
                 $(this).siblings("#num").val(0);
                 return false;
                 }else{
                  $(this).siblings("#num").val(num);
                 }
            var data = {
                num: -1,
                good_id: good_id
            }
            pst(data);
        })
        //下单后删除购物车小标
        $('#add_cart').click(function(){
            $("#cart_number").text(0);
        })
    })
    </script>
@stop


