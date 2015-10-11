@extends('layouts.wechat')
@section('css')

@stop
@section('content')

    <div data-am-widget="list_news" class="am-list-news am-list-news-default">
        <div class="am-list-news-bd">
            <ul class="am-list">
                @foreach($goods as $good)
                        <!--缩略图在标题左边-->
                <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left">
                    <div class="am-u-sm-4 am-list-thumb">
                        <a href="{{url('good', [$good->id])}}" class="">
                            <img src="{{$good->thumb}}" alt="我很囧，你保重....晒晒旅行中的那些囧！"/>
                        </a>
                    </div>

                    <div class=" am-u-sm-8 am-list-main">
                        <h3 class="am-list-item-hd">
                            <a href="{{url('good', [$good->id])}}" class="">{{$good->name}}</a>
                        </h3>

                        <div class="am-list-item-text">
                            {{$good->price}}
                        </div>

                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
@stop

@section('js')

    <script>

    </script>
@stop

